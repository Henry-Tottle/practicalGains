<?php

namespace App\Controllers;

use App\Models\ExercisesModel;

class InsertExerciseController
{
    private ExercisesModel $exerciseModel;

    public function __construct(ExercisesModel $exerciseModel)
    {
        $this->exerciseModel = $exerciseModel;
    }

    public function __invoke($request, $response)
    {
        $exercises = $request->getParsedBody();
        $exercises['user_id'] = $_SESSION['user_id'];

        if (empty($exercises['user_id']) || empty($exercises['name']) || empty($exercises['reps']) || empty($exercises['date']))
        {
            $_SESSION['message'] = 'Please fill out required fields';
            return $response->withHeader('Location', "/dashboard")->withStatus(302);
        }

        if ($exercises['weight_kg'] === '')
        {
            $exercises['weight_kg'] = null;
        }
        if ($exercises['height_in'] === '')
        {
            $exercises['height_in'] = null;
        }

        $this->exerciseModel->insertExercise($exercises);
        $_SESSION['message'] = 'Exercise inserted successfully';

        return $response->withHeader('Location', "/dashboard")->withStatus(302);
    }
}