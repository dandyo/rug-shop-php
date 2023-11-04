<?php

// namespace App\Models;

class Order
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

    public function getOrders()
    {
        $this->db->query('SELECT * 
                          FROM orders ORDER BY created_at DESC
                          ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function addOrder($data)
    {
        $this->db->query('INSERT INTO orders (name, email, phone, address1, address2, city, state, zip, cart, status) VALUES(:name, :email, :phone, :address1, :address2, :city, :state, :zip, :cart, :status)');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address1', $data['address1']);
        $this->db->bind(':address2', $data['address2']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':state', $data['state']);
        $this->db->bind(':zip', $data['zip']);
        $this->db->bind(':cart', $data['cartContent']);
        $this->db->bind(':status', 'new');

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function show($id)
    {
        $this->db->query("SELECT *
                          FROM orders      
                          WHERE id=:id
                          ");

        $this->db->bind(':id', $id);
        $results = $this->db->single();
        return $results;
    }

    public function getOrdersPage($offset = 0, $limit = 20)
    {
        $this->db->query('SELECT * 
                          FROM orders ORDER BY created_at DESC LIMIT ' . $offset . ', ' . $limit . '
                          ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function searchOrders($key)
    {
        $this->db->query("SELECT * 
                          FROM orders 
                          WHERE name LIKE '%$key%' OR 
                          status LIKE '%$key%' OR 
                          address1 LIKE '%$key%' OR 
                          email LIKE '%$key%' OR 
                          phone LIKE '%$key%' ORDER BY created_at DESC");
        $results = $this->db->resultSet();
        return $results;
    }

    public function searchOrdersPage($key, $offset = 0, $limit = 20)
    {
        $this->db->query("SELECT * 
                          FROM orders 
                          WHERE name LIKE '%$key%' OR 
                          status LIKE '%$key%' OR 
                          address1 LIKE '%$key%' OR 
                          email LIKE '%$key%' OR 
                          phone LIKE '%$key%' ORDER BY created_at DESC LIMIT " . $offset . ", " . $limit);
        $results = $this->db->resultSet();
        return $results;
    }

    public function updateOrder($data)
    {
        $this->db->query('UPDATE orders SET status=:status WHERE id =:id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM orders where id=:id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
