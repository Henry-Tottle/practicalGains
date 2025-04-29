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

    public function registerUser(string $userName, string $email, string $password)
    {
        $query = $this->db->prepare("INSERT INTO users (userName, email, hashedPassword) VALUES (?, ?, ?)");
        $query->bindParam(1, $userName);
        $query->bindParam(2, $email);
        $query->bindParam(3, $password);
        $query->execute();
    }
}