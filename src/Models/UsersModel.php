<?php

namespace App\Models;

use PDO;

class UsersModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getUsers()
    {
        $query = $this->db->prepare("SELECT `userName` FROM users");
        $query->execute();
        return $query->fetchAll();
    }
}