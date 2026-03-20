<?php

require_once __DIR__ . '/Model.php';

class NotificationModel extends Model
{
    protected $table = 'notifications';

    // =========================
    // LISTAR NOTIFICAÇÕES
    // =========================
    public function getByUser($userId)
    {
        $stmt = $this->db()->prepare("
            SELECT * FROM {$this->table}
            WHERE user_id = ?
            ORDER BY id DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    // =========================
    // MARCAR COMO LIDA
    // =========================
    public function markAsRead($id, $userId)
    {
        $stmt = $this->db()->prepare("
            UPDATE {$this->table}
            SET read_at = NOW()
            WHERE id = ? AND user_id = ?
        ");
        return $stmt->execute([$id, $userId]);
    }
}
