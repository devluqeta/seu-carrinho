<?php

class ItemController extends Controller
{
    private $itemModel;
    private $listModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->listModel = new ListModel();
    }

    // =========================
    // LISTAR ITENS
    // =========================
    public function index()
    {
        AuthMiddleware::handle();

        $listId = $_GET['list_id'] ?? null;
        $user = $_SESSION['user'];

        // 🔥 valida lista primeiro
        $list = $this->listModel->findSecure($listId, $user['id'], $user['role']);

        if (!$list) {
            http_response_code(403);
            die('Acesso negado');
        }

        $items = $this->itemModel->getByList($listId);

        $this->view('items/index', compact('items', 'list'));
    }

    // =========================
    // CRIAR ITEM
    // =========================
    public function store()
    {
        AuthMiddleware::handle();

        $listId = $_POST['list_id'];
        $user = $_SESSION['user'];

        $list = $this->listModel->findSecure($listId, $user['id'], $user['role']);

        if (!$list) {
            die('Acesso negado');
        }

        $this->itemModel->create([
            'list_id' => $listId,
            'name' => $_POST['name'],
            'quantity' => $_POST['quantity'],
            'food_id' => $_POST['food_id'] ?? null
        ]);

        $this->redirect('/items?list_id=' . $listId);
    }

    // =========================
    // CHECK ITEM
    // =========================
    public function check()
    {
        AuthMiddleware::handle();

        $id = $_POST['id'];
        $listId = $_POST['list_id'];
        $user = $_SESSION['user'];

        $list = $this->listModel->findSecure($listId, $user['id'], $user['role']);

        if (!$list) {
            die('Acesso negado');
        }

        $this->itemModel->update($id, [
            'checked' => $_POST['checked']
        ]);

        $this->redirect('/items?list_id=' . $listId);
    }

    // =========================
    // DELETE ITEM
    // =========================
    public function delete()
    {
        AuthMiddleware::handle();

        $id = $_POST['id'];
        $listId = $_POST['list_id'];
        $user = $_SESSION['user'];

        $list = $this->listModel->findSecure($listId, $user['id'], $user['role']);

        if (!$list) {
            die('Acesso negado');
        }

        $this->itemModel->delete($id);

        $this->redirect('/items?list_id=' . $listId);
    }

    // =========================
    // DELETE EM LOTE (ADMIN)
    // =========================
    public function deleteBatch()
    {
        AuthMiddleware::handle(['admin']);

        $ids = $_POST['ids'] ?? [];

        foreach ($ids as $id) {
            $this->itemModel->delete($id);
        }

        $this->redirect('/admin');
    }

    public function foods()
    {
        AuthMiddleware::handle();

        $term = $_GET['q'] ?? '';

        $foodModel = new FoodModel();
        $foods = $foodModel->search($term);

        header('Content-Type: application/json');
        echo json_encode($foods);
    }
}
