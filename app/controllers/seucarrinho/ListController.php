<?php

require_once __DIR__ . '/../../models/seucarrinho/ListModel.php';

class ListController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new ListModel();
    }

    public function index()
    {
        AuthMiddleware::handle();

        $user = $_SESSION['user'];
        $search = $_GET['search'] ?? null;

        $lists = $this->model->getByUser($user['id'], $search);

        $this->view('home/seucarrinho/home/index', compact('lists'));
    }

    public function store()
    {
        AuthMiddleware::handle();

        $userId = $_SESSION['user']['id'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $name = trim($_POST['name'] ?? '');
        $expiresAt = $_POST['expires_at'] ?? null;

        // =========================
        // Validação: Limite de 10 listas/hora por usuário ou IP
        // =========================
        $oneHourAgo = date('Y-m-d H:i:s', strtotime('-1 hour'));
        $recentCount = $this->model->countRecent($userId, $ip, $oneHourAgo);

        if ($recentCount >= 10) {
            $_SESSION['error'] = "Você atingiu o limite de 10 listas por hora.";
            $this->redirect('/seucarrinho/lists');
        }

        // =========================
        // Validação: Data de expiração
        // =========================
        if ($expiresAt) {
            $expiresTime = strtotime($expiresAt);
            $today = strtotime(date('Y-m-d 00:00:00'));
            $maxDate = strtotime('+1 month', $today);

            if ($expiresTime < $today) {
                $_SESSION['error'] = "Não é permitido criar listas em datas passadas.";
                $this->redirect('/seucarrinho/lists');
            }

            if ($expiresTime > $maxDate) {
                $_SESSION['error'] = "A data de expiração não pode ultrapassar 1 mês a partir de hoje.";
                $this->redirect('/seucarrinho/lists');
            }
        }

        // =========================
        // Criar lista
        // =========================
        $this->model->create([
            'user_id' => $userId,
            'name' => $name,
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => $expiresAt,
            'ip_address' => $ip // armazena IP no banco
        ]);

        $this->redirect('/seucarrinho/lists');
    }

    public function update()
    {
        AuthMiddleware::handle();

        $id = $_POST['id'] ?? null;

        if (!$id) die('ID não informado');

        $list = $this->model->find($id);
        if (!$list || $list['user_id'] != $_SESSION['user']['id']) die('Acesso negado');

        $expiresAt = $_POST['expires_at'] ?? null;

        if ($expiresAt) {
            $expiresTime = strtotime($expiresAt);
            $today = strtotime(date('Y-m-d 00:00:00'));
            $maxDate = strtotime('+1 month', $today);

            if ($expiresTime < $today || $expiresTime > $maxDate) {
                $_SESSION['error'] = "Data inválida. Só é permitido datas entre hoje e 1 mês à frente.";
                $this->redirect('/seucarrinho/lists');
            }
        }

        $this->model->update($id, [
            'name' => $_POST['name'],
            'expires_at' => $expiresAt
        ]);

        $this->redirect('/seucarrinho/lists');
    }

    public function delete()
    {
        AuthMiddleware::handle();

        $id = $_POST['id'] ?? null;
        if (!$id) die('ID não informado');

        $list = $this->model->find($id);
        if (!$list || $list['user_id'] != $_SESSION['user']['id']) die('Acesso negado');

        $this->model->delete($id);

        $this->redirect('/seucarrinho/lists');
    }

    // Página da lista individual
    public function show()
    {
        AuthMiddleware::handle();

        $listId = $_POST['id'] ?? null; // agora pega pelo POST
        if (!$listId) die('Lista não encontrada');

        $list = $this->model->find($listId);
        if (!$list || $list['user_id'] != $_SESSION['user']['id']) die('Acesso negado');

        $items = $this->model->getItems($listId);

        $this->view('home/seucarrinho/list/view', compact('list', 'items'));
    }

    // Adicionar item à lista
    public function storeItem()
    {
        AuthMiddleware::handle();

        $listId = $_POST['list_id'] ?? null;
        $itemName = trim($_POST['item_name'] ?? '');
        if (!$listId || !$itemName) die('Dados inválidos');

        $list = $this->model->find($listId);
        if (!$list || $list['user_id'] != $_SESSION['user']['id']) die('Acesso negado');

        $this->model->addItem($listId, $itemName);

        $this->redirect("/seucarrinho/list/view?id={$listId}");
    }

    // Deletar item da lista
    public function deleteItem()
    {
        AuthMiddleware::handle();

        $itemId = $_POST['item_id'] ?? null;
        if (!$itemId) die('Item não informado');

        $item = $this->model->findItem($itemId);
        if (!$item || $item['user_id'] != $_SESSION['user']['id']) die('Acesso negado');

        $this->model->deleteItem($itemId);

        $this->redirect("/seucarrinho/list/view?id={$item['list_id']}");
    }
}
