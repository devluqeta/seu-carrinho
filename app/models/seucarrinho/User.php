<?php

require_once __DIR__ . '/../Model.php';

class User extends Model
{
    protected $table = 'users';

    // ========================
    // CAMPOS DA TABELA users
    // ========================
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function findByEmail($email)
    {
        $stmt = $this->db()->prepare(
            "SELECT * FROM {$this->table} WHERE email = ? LIMIT 1"
        );
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
