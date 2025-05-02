<?php

namespace App\Controllers;

use App\Models\ExercisesModel;
use App\Models\UsersModel;
use Slim\Views\PhpRenderer;


class GetExercisesByUserID
{
    private ExercisesModel $exercisesModel;
    private UsersModel $userModel;
    private PhpRenderer  $renderer;

    public function __construct(ExercisesModel $exercisesModel, UsersModel $userModel, PhpRenderer $renderer)
    {
        $this->exercisesModel = $exercisesModel;
        $this->renderer = $renderer;
        $this->userModel = $userModel;
    }

    public function __invoke($request, $response, $args)
    {
    $data = $this->exercisesModel->getExercisesByUserID($_SESSION['user_id']);
    $username = $this->userModel->getUserById($_SESSION['user_id']);
    return $this->renderer->render($response, 'dashboard.phtml', ['exercises' => $data, 'username' => $username]);
    }
}