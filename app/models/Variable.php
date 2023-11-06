<?php

// namespace App\Models;

class Variable
{
    private $db;

    /**
     * Post constructor.
     * @param null $data
     */
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllVariables()
    {
        $this->db->query("SELECT * FROM variables");
        $results = $this->db->resultSet();
        return $results;
    }

    public function getVariable($id)
    {
        $this->db->query("SELECT * FROM variables WHERE id=:id");

        $this->db->bind(':id', $id);
        $results = $this->db->single();
        return $results;
    }

    public function checkVariable($data)
    {
        $this->db->query("SELECT * FROM variables WHERE type=:type AND value=:value");

        $this->db->bind(':type', $data['type']);
        $this->db->bind(':value', $data['value']);
        $results = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add($data)
    {
        $this->db->query('INSERT INTO variables (type, name, value) VALUES(:type, :name, :value)');

        $this->db->bind(':type', $data['type']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':value', $data['value']);

        if ($this->db->execute()) {
            $newid = $this->db->getLastId();
            return $newid;
        } else {
            return false;
        }
    }
    public function update($data)
    {
        $this->db->query('UPDATE variables SET name=:name, value=:value WHERE id =:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':value', $data['value']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($id)
    {
        $this->db->query('DELETE FROM variables where id=:id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}