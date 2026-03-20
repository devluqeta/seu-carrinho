<?php

require_once __DIR__ . '/Model.php';

class FoodSuggestionModel extends Model
{
    protected $table = 'food_suggestions';

    public function getPending()
    {
        return $this->db()->query("
            SELECT fs.*, users.name as user_name
            FROM food_suggestions fs
            JOIN users ON users.id = fs.user_id
            WHERE fs.status = 'pending'
            ORDER BY fs.id DESC
        ")->fetchAll();
    }
}
