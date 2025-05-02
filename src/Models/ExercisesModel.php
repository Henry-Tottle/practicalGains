<?php

namespace App\Models;

use PDO;

class ExercisesModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getExercisesByUserID(int $userID)
    {
        $query = $this->db->prepare("SELECT `user_id`, `exercises`.`name` 
    AS `exercise`, `reps`, `sets`, `weight_kg`, `height_in`, `difficulty`, `notes`, `date`, `userName` 
    FROM `users` 
    LEFT JOIN `exercises` 
    ON `users`.`id` = `exercises`.`user_id` 
    WHERE `users`.`id` = :userID");
        $query->execute(['userID' => $userID]);
        return $query->fetchAll();
    }
}