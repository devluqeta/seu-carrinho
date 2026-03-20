<?php

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

        if ($user['role'] === 'admin') {
            $lists = $this->model->getAll();
        } else {
            $lists = $this->model->getUserListsWithShared($user['id']); // 🔥 correto
        }

        $this->view('lists/index', compact('lists'));
    }

    public function show()
    {
        AuthMiddleware::handle();

        $id = $_GET['id'];
        $user = $_SESSION['user'];

        $list = $this->model->findWithAccess($id, $user['id'], $user['role']);

        if (!$list) {
            die('Acesso negado');
        }

        $this->view('lists/show', compact('list'));
    }

    public function store()
    {
        AuthMiddleware::handle();

        // ID do usuário logado
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            $_SESSION['error'] = "Usuário não identificado";
            return $this->redirect('/');
        }

        // 🔒 Verifica se usuário existe no banco
        $userModel = new User();
        $user = $userModel->find($userId);

        if (!$user) {
            // Usuário não existe ou foi deletado
            session_destroy();
            die("Usuário inválido. Faça login novamente.");
        }

        // Valida o campo 'name'
        $listName = trim($_POST['name'] ?? '');
        if (empty($listName)) {
            $_SESSION['error'] = "O nome da lista é obrigatório";
            return $this->redirect('/home');
        }

        try {
            // Cria a lista de forma segura
            $this->model->create([
                'name' => $listName,
                'user_id' => $userId
            ]);

            $_SESSION['success'] = "Lista criada com sucesso!";
            $this->redirect('/home');
        } catch (\PDOException $e) {
            // Se ocorrer erro de FK, mostra mensagem amigável
            if ($e->getCode() == 23000) {
                $_SESSION['error'] = "Não foi possível criar a lista: usuário inválido.";
            } else {
                $_SESSION['error'] = "Erro ao criar a lista: " . $e->getMessage();
            }
            $this->redirect('/home');
        }
    }


    public function delete()
    {
        AuthMiddleware::handle();

        $this->model->deleteSecure(
            $_POST['id'],
            $_SESSION['user']['id'],
            $_SESSION['user']['role']
        );

        $this->redirect('/home');
    }
}
