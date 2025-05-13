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

    public function insertExercise(array $exercise)
    {
        $query = $this->db->prepare("INSERT INTO `exercises` (`user_id`, `name`, `reps`, `sets`, `weight_kg`, `height_in`, `difficulty`, `notes`, `date`) VALUES (:user_id, :name, :reps, :sets, :weight_kg, :height_in, :difficulty, :notes, :date)");
        $query->execute([
            'user_id' => $exercise['user_id'],
            'name' => $exercise['name'],
            'reps' => $exercise['reps'],
            'sets' => $exercise['sets'],
            'weight_kg' => $exercise['weight_kg'],
            'height_in' => $exercise['height_in'],
            'difficulty' => $exercise['difficulty'],
            'notes' => $exercise['notes'],
            'date' => $exercise['date']
        ]);
        return $this->db->lastInsertId();
    }
}