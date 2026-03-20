<?php

require_once __DIR__ . '/Model.php';

class ListModel extends Model
{
    protected $table = 'lists';

    // =========================
    // LISTAS DO USUÁRIO
    // =========================
    public function getUserListsWithShared($userId)
    {
        $stmt = $this->db()->prepare("
        SELECT DISTINCT l.* 
        FROM lists l
        LEFT JOIN list_shares s 
            ON s.list_id = l.id
        WHERE 
            l.user_id = ?
            OR (
                s.target_user_id = ?
                AND s.status = 'accepted'
            )
        ORDER BY l.id DESC
    ");

        $stmt->execute([$userId, $userId]);
        return $stmt->fetchAll();
    }

    // =========================
    // TODAS LISTAS (ADMIN)
    // =========================
    public function getAll()
    {
        $stmt = $this->db()->query("
            SELECT lists.*, users.name as user_name
            FROM lists
            JOIN users ON users.id = lists.user_id
            ORDER BY lists.id DESC
        ");
        return $stmt->fetchAll();
    }

    // =========================
    // BUSCAR LISTA COM SEGURANÇA
    // =========================
    public function findSecure($listId, $userId, $role)
    {
        if ($role === 'admin') {
            $stmt = $this->db()->prepare("
                SELECT * FROM {$this->table} WHERE id = ?
            ");
            $stmt->execute([$listId]);
        } else {
            $stmt = $this->db()->prepare("
                SELECT * FROM {$this->table}
                WHERE id = ? AND user_id = ?
            ");
            $stmt->execute([$listId, $userId]);
        }

        return $stmt->fetch();
    }

    // =========================
    // DELETE SEGURO
    // =========================
    public function deleteSecure($listId, $userId, $role)
    {
        if ($role === 'admin') {
            $stmt = $this->db()->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$listId]);
        }

        $stmt = $this->db()->prepare("
            DELETE FROM {$this->table}
            WHERE id = ? AND user_id = ?
        ");
        return $stmt->execute([$listId, $userId]);
    }

    public function findWithAccess($listId, $userId, $role)
    {
        if ($role === 'admin') {
            $stmt = $this->db()->prepare("SELECT * FROM lists WHERE id = ?");
            $stmt->execute([$listId]);
            return $stmt->fetch();
        }

        $stmt = $this->db()->prepare("
        SELECT l.* FROM lists l
        LEFT JOIN list_shares s 
            ON s.list_id = l.id 
            AND s.target_user_id = ?
            AND s.status = 'accepted'
        WHERE l.id = ?
        AND (
            l.user_id = ?
            OR s.id IS NOT NULL
        )
        LIMIT 1
    ");

        $stmt->execute([$userId, $listId, $userId]);
        return $stmt->fetch();
    }

    public function getNotifications($userId)
    {
        $stmt = $this->db()->prepare("
        SELECT * FROM notifications
        WHERE user_id = ?
        ORDER BY id DESC
    ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
