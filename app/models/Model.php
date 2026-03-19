<?php

abstract class Model
{
    protected $table; // TABELA
    protected $primaryKey = 'id';
    protected $fillable = []; // CAMPOS DA TABELA QUE DEVEM INSERIR (INSERT)

    protected function db()
    {
        return Database::getConnection();
    }

    // =======================
    // FUNÇÃO SELECIONA TUDA
    // =======================
    public function all()
    {
        $stmt = $this->db()->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    // =================
    // FUNÇÃO DE BUSCA
    // =================
    public function find($id)
    {
        $stmt = $this->db()->prepare(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ? LIMIT 1"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // ==============
    // FUNÇÃO WHERE
    // ==============
    public function where($field, $value)
    {
        $stmt = $this->db()->prepare(
            "SELECT * FROM {$this->table} WHERE {$field} = ?"
        );
        $stmt->execute([$value]);
        return $stmt->fetchAll();
    }

     // ============================
    // FUNÇÃO DE CRIAR INFORMAÇÕES
    // =============================
    public function create($data)
    {
        $fields = [];
        $placeholders = [];
        $values = [];

        foreach ($this->fillable as $field) {
            if (isset($data[$field])) {
                $fields[] = $field;
                $placeholders[] = "?";
                $values[] = $data[$field];
            }
        }

        $sql = "INSERT INTO {$this->table} 
                (" . implode(',', $fields) . ") 
                VALUES (" . implode(',', $placeholders) . ")";

        $stmt = $this->db()->prepare($sql);
        $stmt->execute($values);

        return $this->db()->lastInsertId();
    }

    // ==========================================
    // FUNÇÃO DE ATUALIZAR / EDITAR INFORMAÇÕES
    // ==========================================
    public function update($id, $data)
    {
        $fields = [];
        $values = [];

        foreach ($this->fillable as $field) {
            if (isset($data[$field])) {
                $fields[] = "{$field} = ?";
                $values[] = $data[$field];
            }
        }

        $values[] = $id;

        $sql = "UPDATE {$this->table} 
                SET " . implode(',', $fields) . "
                WHERE {$this->primaryKey} = ?";

        $stmt = $this->db()->prepare($sql);
        return $stmt->execute($values);
    }

    // ============================
    // FUNÇÃO DELETAR INFORMAÇÕES
    // ============================
    public function delete($id)
    {
        $stmt = $this->db()->prepare(
            "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?"
        );
        return $stmt->execute([$id]);
    }
}
