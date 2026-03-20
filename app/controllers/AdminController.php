<?php

class AdminController extends Controller
{
    public function index()
    {
        echo "<h1>Painel Admin</h1>";
        echo "<p>Bem-vindo, " . $_SESSION['user']['name'] . "</p>";
    }

    public function foods()
    {
        AuthMiddleware::handle(['admin']);

        $foodModel = new FoodModel();
        $foods = $foodModel->getAll();

        $this->view('admin/foods', compact('foods'));
    }

    public function storeFood()
    {
        AuthMiddleware::handle(['admin']);

        $foodModel = new FoodModel();

        $foodModel->create([
            'name' => $_POST['name'],
            'unit' => $_POST['unit']
        ]);

        $this->redirect('/admin/foods');
    }

    public function suggestions()
    {
        AuthMiddleware::handle(['admin']);

        $model = new FoodSuggestionModel();
        $suggestions = $model->getPending();

        $this->view('admin/suggestions', compact('suggestions'));
    }

    public function approveSuggestion()
    {
        AuthMiddleware::handle(['admin']);

        $id = $_POST['id'];
        $name = $_POST['name'];
        $unit = $_POST['unit'];

        $db = Database::getConnection();

        // cria no autocomplete
        $stmt = $db->prepare("
        INSERT INTO foods (name, unit)
        VALUES (?, ?)
    ");
        $stmt->execute([$name, $unit]);

        // atualiza sugestão
        $stmt = $db->prepare("
        UPDATE food_suggestions
        SET status = 'approved'
        WHERE id = ?
    ");
        $stmt->execute([$id]);

        // pega user
        $stmt = $db->prepare("SELECT user_id FROM food_suggestions WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        // notifica
        $stmt = $db->prepare("
        INSERT INTO notifications (user_id, type, message)
        VALUES (?, 'suggestion', ?)
    ");
        $stmt->execute([$user['user_id'], "Sua sugestão foi aprovada"]);

        $this->redirect('/admin/suggestions');
    }

    public function denySuggestion()
    {
        AuthMiddleware::handle(['admin']);

        $id = $_POST['id'];
        $reason = $_POST['reason'];

        $db = Database::getConnection();

        // pega user antes
        $stmt = $db->prepare("SELECT user_id FROM food_suggestions WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        // atualiza
        $stmt = $db->prepare("
        UPDATE food_suggestions
        SET status = 'denied', admin_response = ?
        WHERE id = ?
    ");
        $stmt->execute([$reason, $id]);

        // notifica
        $msg = "Sugestão negada: " . $reason;

        $stmt = $db->prepare("
        INSERT INTO notifications (user_id, type, message)
        VALUES (?, 'suggestion', ?)
    ");
        $stmt->execute([$user['user_id'], $msg]);

        $this->redirect('/admin/suggestions');
    }
}
