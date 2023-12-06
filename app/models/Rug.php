<?php

// namespace App\Models;

class Rug
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

    public function getRugs()
    {
        $this->db->query('SELECT * 
                          FROM rugs
                          ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getRugsPage($offset = 0, $limit = 20)
    {
        $this->db->query('SELECT * 
                          FROM rugs ORDER BY created_at DESC LIMIT ' . $offset . ', ' . $limit . '
                          ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function searchRugs($key)
    {
        $this->db->query("SELECT * 
                          FROM rugs 
                          WHERE asset_number LIKE '%$key%' OR 
                          design_name LIKE '%$key%' OR 
                          location LIKE '%$key%' OR 
                          description LIKE '%$key%' ORDER BY created_at DESC");
        $results = $this->db->resultSet();
        return $results;
    }

    public function searchRugsPage($key, $offset = 0, $limit = 20)
    {
        $this->db->query("SELECT * 
                          FROM rugs 
                          WHERE asset_number LIKE '%$key%' OR 
                          design_name LIKE '%$key%' OR 
                          location LIKE '%$key%' OR 
                          description LIKE '%$key%' ORDER BY created_at DESC LIMIT " . $offset . ", " . $limit);
        $results = $this->db->resultSet();
        return $results;
    }

    public function addRug($data)
    {
        $this->db->query('INSERT INTO rugs (location, asset_number, design_name, shape, size_width_ft, size_length_ft, size_width_in, size_length_in, material, collection, primary_color, secondary_color, age, construction, image, gallery, description) VALUES(:location, :asset_number, :design_name, :shape, :size_width_ft, :size_length_ft, :size_width_in, :size_length_in, :material, :collection, :primary_color, :secondary_color, :age, :construction, :image, :gallery, :description)');

        $this->db->bind(':location', $data['location']);
        $this->db->bind(':asset_number', $data['asset_number']);
        $this->db->bind(':design_name', $data['design_name']);
        $this->db->bind(':shape', $data['shape']);
        $this->db->bind(':size_width_ft', $data['size_width_ft']);
        $this->db->bind(':size_length_ft', $data['size_length_ft']);
        $this->db->bind(':size_width_in', $data['size_width_in']);
        $this->db->bind(':size_length_in', $data['size_length_in']);
        $this->db->bind(':material', $data['material']);
        $this->db->bind(':collection', $data['collection']);
        $this->db->bind(':primary_color', $data['primary_color']);
        $this->db->bind(':secondary_color', $data['secondary_color']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':construction', $data['construction']);
        $this->db->bind(':image', $data['new_image']);
        $this->db->bind(':gallery', $data['gallery']);
        $this->db->bind(':description', $data['description']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateRug($data)
    {
        $this->db->query('UPDATE rugs SET location=:location, asset_number=:asset_number, design_name=:design_name, shape=:shape, size_width_ft=:size_width_ft,size_length_ft=:size_length_ft,size_width_in=:size_width_in, size_length_in=:size_length_in, material=:material, collection=:collection, primary_color=:primary_color, secondary_color=:secondary_color, age=:age, construction=:construction, image=:image, gallery=:gallery, description=:description WHERE id =:id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':asset_number', $data['asset_number']);
        $this->db->bind(':design_name', $data['design_name']);
        $this->db->bind(':shape', $data['shape']);
        $this->db->bind(':size_width_ft', $data['size_width_ft']);
        $this->db->bind(':size_length_ft', $data['size_length_ft']);
        $this->db->bind(':size_width_in', $data['size_width_in']);
        $this->db->bind(':size_length_in', $data['size_length_in']);
        $this->db->bind(':material', $data['material']);
        $this->db->bind(':collection', $data['collection']);
        $this->db->bind(':primary_color', $data['primary_color']);
        $this->db->bind(':secondary_color', $data['secondary_color']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':construction', $data['construction']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':gallery', $data['gallery']);
        $this->db->bind(':description', $data['description']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function show($id)
    {
        $this->db->query("SELECT *
                          FROM rugs      
                          WHERE id=:id
                          ");
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        return $results;
    }

    public function editRug($data)
    {
    }

    public function deleteRug($id)
    {
        $this->db->query('DELETE FROM rugs where id=:id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function removeRugImage($id)
    {
        $this->db->query('UPDATE rugs SET image="" WHERE id =:id');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function refineSearch($params, $offset = 0, $limit = null)
    {
        // $where = ' WHERE';
        $whereCount = 0;

        if (!empty($params)) {
            $where = ' WHERE';

            // if (!empty($params['shape'])) {
            //     $where = $where . ' shape = "' . $params['shape'] . '"';
            //     $whereCount++;
            // }

            if (isset($params['size_width_ft_min']) && $params['size_width_ft_min'] != "" && isset($params['size_width_ft_max']) && $params['size_width_ft_max'] != "") {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' size_width_ft BETWEEN ' . $params['size_width_ft_min'] . ' AND ' . $params['size_width_ft_max'] . '';
                $whereCount++;
            }

            if (isset($params['size_width_in_min']) && $params['size_width_in_min'] != "" && isset($params['size_width_in_max']) && $params['size_width_in_max'] != "") {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' size_width_in BETWEEN ' . $params['size_width_in_min'] . ' AND ' . $params['size_width_in_max'] . '';
                $whereCount++;
            } else if (isset($params['size_width_in_min']) && $params['size_width_in_min'] != "" && empty($params['size_width_in_max'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' size_width_in BETWEEN ' . $params['size_width_in_min'] . ' AND 0';
                $whereCount++;
            } else if (empty($params['size_width_in_min']) && isset($params['size_width_in_max']) && $params['size_width_in_max'] != "") {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' size_width_in BETWEEN 0 AND ' . $params['size_width_in_max'];
                $whereCount++;
            }

            if (isset($params['size_length_ft_min']) && $params['size_length_ft_min'] != "" && !empty($params['size_length_ft_max']) && $params['size_length_ft_max'] != "") {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' size_length_ft BETWEEN ' . $params['size_length_ft_min'] . ' AND ' . $params['size_length_ft_max'] . '';
                $whereCount++;
            }

            if (isset($params['size_length_in_min']) && $params['size_length_in_min'] != "" && isset($params['size_length_in_max']) && $params['size_length_in_max'] != "") {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' size_length_in BETWEEN ' . $params['size_length_in_min'] . ' AND ' . $params['size_length_in_max'] . '';
                $whereCount++;
            } else if (isset($params['size_length_in_min']) && $params['size_length_in_min'] != "" && empty($params['size_length_in_max'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' size_length_in BETWEEN ' . $params['size_length_in_min'] . ' AND 0';
                $whereCount++;
            } else if (empty($params['size_length_in_min']) && isset($params['size_length_in_max']) && $params['size_length_in_max'] != "") {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' size_length_in BETWEEN 0 AND ' . $params['size_length_in_max'];
                $whereCount++;
            }

            if (!empty($params['primary_color'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' primary_color IN ("' . implode('","', $params['primary_color']) . '")';
                $whereCount++;
            }

            if (!empty($params['secondary_color'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' secondary_color IN ("' . implode('","', $params['secondary_color']) . '")';
                $whereCount++;
            }

            if (!empty($params['collection'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' collection IN ("' . implode('","', $params['collection']) . '")';
                $whereCount++;
            }

            if (!empty($params['construction'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' construction = "' . $params['construction'] . '"';
                $whereCount++;
            }

            if (!empty($params['age'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' age IN ("' . implode('","', $params['age']) . '")';
                $whereCount++;
            }

            if (!empty($params['material'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                $where = $where . ' material IN ("' . implode('","', $params['material']) . '")';
                $whereCount++;
            }

            if (!empty($params['location'])) {
                if ($whereCount > 0) {
                    $where = $where . ' AND';
                }
                // $where = 
                $where = $where . ' location IN ("' . implode('","', $params['location']) . '")';
                $whereCount++;
            }

            if ($whereCount == 0) {
                $where = '';
            }
        } else {
            $where = '';
        }

        // echo $where . '<br>';


        $limitQuery = ($limit != null) ? ' LIMIT ' . $offset . ', ' . $limit : '';

        $this->db->query('SELECT * FROM rugs' . $where . $limitQuery);

        $results = $this->db->resultSet();
        return $results;
    }

    public function getRugsIn($ids)
    {
        $cartIDS = unserialize($ids);

        $this->db->query('SELECT *
                          FROM rugs      
                          WHERE id IN ("' . implode('","', $cartIDS) . '")
                          ');
        // $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        return $results;
    }
}
