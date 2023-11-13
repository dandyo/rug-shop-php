<?php
// namespace App\Models;

class Image
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

    public function add($data)
    {
        $this->db->query('INSERT INTO images (filename, size, type) VALUES (:filename, :size, :type)');

        $this->db->bind(':filename', $data['filename']);
        $this->db->bind(':size', $data['size']);
        $this->db->bind(':type', $data['type']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function remove($filename)
    {
        $this->db->query('DELETE FROM images WHERE filename=:filename');

        $this->db->bind(':filename', $filename);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function get($id)
    {
        $this->db->query("SELECT * 
                          FROM images 
                          WHERE id=" . $id);
        $results = $this->db->resultSet();
        return $results;
    }
}