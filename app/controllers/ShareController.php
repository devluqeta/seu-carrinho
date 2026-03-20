<?php

class ShareController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function send()
    {
        AuthMiddleware::handle();

        $listId = $_POST['list_id'];
        $emails = $_POST['emails']; // array
        $user = $_SESSION['user'];

        // 🔥 limite de 5 pessoas (incluindo dono)
        if (count($emails) > 4) {
            die("Máximo de 5 usuários por lista");
        }

        foreach ($emails as $email) {

            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $target = $stmt->fetch();

            if (!$target) {
                continue; // ou logar erro
            }

            // cria share
            $stmt = $this->db->prepare("
                INSERT INTO list_shares (list_id, owner_id, target_user_id)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$listId, $user['id'], $target['id']]);

            // notificação
            $stmt = $this->db->prepare("
                INSERT INTO notifications (user_id, type, message)
                VALUES (?, 'share', ?)
            ");
            $msg = "Você recebeu um convite para uma lista";
            $stmt->execute([$target['id'], $msg]);
        }

        $this->redirect('/list?id=' . $listId);
    }

    public function accept()
    {
        AuthMiddleware::handle();

        $id = $_POST['share_id'];
        $userId = $_SESSION['user']['id'];

        $stmt = $this->db->prepare("
        UPDATE list_shares 
        SET status = 'accepted'
        WHERE id = ? AND target_user_id = ?
    ");
        $stmt->execute([$id, $userId]);

        $this->redirect('/');
    }

    public function deny()
    {
        AuthMiddleware::handle();

        $id = $_POST['share_id'];
        $userId = $_SESSION['user']['id'];

        // pega info antes
        $stmt = $this->db->prepare("SELECT * FROM list_shares WHERE id = ?");
        $stmt->execute([$id]);
        $share = $stmt->fetch();

        // atualiza
        $stmt = $this->db->prepare("
        UPDATE list_shares 
        SET status = 'denied'
        WHERE id = ?
    ");
        $stmt->execute([$id]);

        // notifica dono
        $stmt = $this->db->prepare("
        INSERT INTO notifications (user_id, type, message)
        VALUES (?, 'share', ?)
    ");

        $msg = "Seu convite foi recusado";
        $stmt->execute([$share['owner_id'], $msg]);

        $this->redirect('/');
    }
}
