<?php

require_once __DIR__ . '/Model.php';

class FoodModel extends Model
{
    protected $table = 'foods';

    public function search($term)
    {
        $stmt = $this->db()->prepare("
            SELECT * FROM {$this->table}
            WHERE name LIKE ?
            LIMIT 10
        ");
        $stmt->execute(["%$term%"]);
        return $stmt->fetchAll();
    }

    public function getAll()
    {
        return $this->db()->query("SELECT * FROM foods ORDER BY name ASC")->fetchAll();
    }
}
