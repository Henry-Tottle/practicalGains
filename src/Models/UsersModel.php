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

    public function getUserById(int $id)
    {
        $query = $this->db->prepare("SELECT `userName` FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public function registerUser(string $userName, string $email, string $password)
    {
        $query = $this->db->prepare("INSERT INTO users (userName, email, hashedPassword) VALUES (:userName, :email, :password)");

        $query->execute(['userName' => $userName, 'email' => $email, 'password' => $password]);
    }

    public function getUserByEmail(string $email)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email'=>$email]);
        return $query->fetch();

    }
}