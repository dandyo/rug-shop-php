<?php
// namespace App\Models;
class User
{
    private $db;

    /**
     * User constructor.
     * @param null $data
     */
    public function __construct()
    {
        $this->db = new Database;
    }
    //find user through email
    public function findUserByEmail($email)
    {
        // $this->db->bind(':email', $email);
        $this->db->query('SELECT * FROM users WHERE email= :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        //check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password, role) VALUES(:name, :email, :password, :role)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function login($email,  $password)
    {
        $this->db->query('SELECT *FROM users WHERE email=:email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
    public function getUserbyId($user_id)
    {
        $this->db->query('SELECT * FROM users WHERE id= :user_id');
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->single();
        return $row;
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT id, name, email, role FROM users");
        $results = $this->db->resultSet();
        return $results;
    }

    public function update($data)
    {
        $this->db->query('UPDATE users SET name=:name, email=:email,role=:role WHERE id=:id');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateWithPassword($data)
    {
        $this->db->query('UPDATE users SET name=:name, email=:email,role=:role, password=:password WHERE id=:id');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM users where id=:id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
