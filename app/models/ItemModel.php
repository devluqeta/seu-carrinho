<?php

require_once __DIR__ . '/Model.php';

class ItemModel extends Model
{
    protected $table = 'items';

    // =========================
    // PEGAR ITENS DE UMA LISTA
    // =========================
    public function getByList($listId)
    {
        $stmt = $this->db()->prepare("
            SELECT items.*, foods.unit
            FROM items
            LEFT JOIN foods ON foods.id = items.food_id
            WHERE list_id = ?
            ORDER BY id DESC
        ");
        $stmt->execute([$listId]);
        return $stmt->fetchAll();
    }

    // =========================
    // DELETE SEGURO
    // =========================
    public function deleteByListSecure($listId, $userId, $role)
    {
        if ($role === 'admin') {
            $stmt = $this->db()->prepare("DELETE FROM items WHERE list_id = ?");
            return $stmt->execute([$listId]);
        }

        $stmt = $this->db()->prepare("
            DELETE items FROM items
            JOIN lists ON lists.id = items.list_id
            WHERE items.list_id = ?
            AND lists.user_id = ?
        ");
        return $stmt->execute([$listId, $userId]);
    }
}
