<?php

namespace App\Controllers;

use App\Models\ExercisesModel;
use Slim\Views\PhpRenderer;

class GetExercisesByUserID
{
    private ExercisesModel $exercisesModel;
    private PhpRenderer  $renderer;

    public function __construct(ExercisesModel $exercisesModel, PhpRenderer $renderer)
    {
        $this->exercisesModel = $exercisesModel;
        $this->renderer = $renderer;
    }

    public function __invoke($request, $response, $args)
    {
    $data = $this->exercisesModel->getExercisesByUserID($_SESSION['user_id']);
    return $this->renderer->render($response, 'dashboard.phtml', ['exercises' => $data]);
    }
}