<?php

// namespace App\Models;

class Setting
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

    public function getSetting($setting)
    {
        $this->db->query("SELECT *
                          FROM settings      
                          WHERE setting=:setting
                          ");

        $this->db->bind(':setting', $setting);
        $results = $this->db->single();
        return $results;
    }

    public function getAllSettings()
    {
        $this->db->query("SELECT *
                          FROM settings");
        $results = $this->db->resultSet();
        return $results;
    }

    public function updateSetting($setting, $value)
    {
        $this->db->query('UPDATE settings SET value=:value WHERE setting =:setting');

        $this->db->bind(':setting', $setting);
        $this->db->bind(':value', $value);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
