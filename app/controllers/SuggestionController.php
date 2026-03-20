<?php

class SuggestionController extends Controller
{
    public function store()
    {
        AuthMiddleware::handle();

        $name = trim($_POST['name']);
        $userId = $_SESSION['user']['id'];

        if (empty($name)) {
            die("Nome inválido");
        }

        $model = new FoodSuggestionModel();

        $model->create([
            'name' => $name,
            'user_id' => $userId
        ]);

        // notificar admin (opcional: todos admins)
        $db = Database::getConnection();

        $admins = $db->query("SELECT id FROM users WHERE role = 'admin'")->fetchAll();

        foreach ($admins as $admin) {
            $stmt = $db->prepare("
                INSERT INTO notifications (user_id, type, message)
                VALUES (?, 'suggestion', ?)
            ");
            $stmt->execute([$admin['id'], "Nova sugestão de item"]);
        }

        $this->redirect('/');
    }
}
