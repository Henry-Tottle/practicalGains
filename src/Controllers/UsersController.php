<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class UsersController
{
    private UsersModel $usersModel;
    private PhpRenderer $renderer;
    public function __construct(UsersModel $usersModel, PhpRenderer $renderer)
    {
        $this->usersModel = $usersModel;
        $this->renderer = $renderer;
    }

    public function __invoke($request, $response)
    {
        $users = $this->usersModel->getUsers();
        return $this->renderer->render($response, 'index.php', ['usersArray' =>$users]);
    }
}