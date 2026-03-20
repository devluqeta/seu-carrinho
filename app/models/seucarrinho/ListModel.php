<?php

require_once __DIR__ . '/../Model.php';

class ListModel extends Model
{
    protected $table = 'lists';

    protected $fillable = [
        'user_id',
        'name',
        'expires_at',
        'created_at',
        'ip_address' // novo campo
    ];

    public function getByUser($userId, $search = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        $params = [$userId];

        if ($search) {
            $sql .= " AND name LIKE ?";
            $params[] = "%$search%";
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $this->db()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function countRecent($userId, $ip, $since)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} 
                WHERE (user_id = :userId OR ip_address = :ip) 
                AND created_at >= :since";
        $stmt = $this->db()->prepare($sql);
        $stmt->execute([
            ':userId' => $userId,
            ':ip' => $ip,
            ':since' => $since
        ]);
        return (int) $stmt->fetchColumn();
    }

    public function find($id)
    {
        $stmt = $this->db()->prepare("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getItems($listId)
    {
        $stmt = $this->db()->prepare("SELECT * FROM list_items WHERE list_id = ? ORDER BY id DESC");
        $stmt->execute([$listId]);
        return $stmt->fetchAll();
    }

    public function addItem($listId, $name)
    {
        $stmt = $this->db()->prepare("INSERT INTO list_items (list_id, name, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$listId, $name]);
    }

    public function findItem($itemId)
    {
        $stmt = $this->db()->prepare("
        SELECT li.*, l.user_id, li.list_id 
        FROM list_items li
        INNER JOIN lists l ON li.list_id = l.id
        WHERE li.id = ? 
        LIMIT 1
    ");
        $stmt->execute([$itemId]);
        return $stmt->fetch();
    }

    public function deleteItem($itemId)
    {
        $stmt = $this->db()->prepare("DELETE FROM list_items WHERE id = ?");
        $stmt->execute([$itemId]);
    }
}
