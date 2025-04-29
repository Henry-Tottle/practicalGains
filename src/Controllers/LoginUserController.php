<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Slim\Views\PhpRenderer;

class LoginUserController
{
    private UsersModel $usersModel;
    private PhpRenderer $renderer;
    public function __construct(UsersModel $usersModel, PhpRenderer $renderer)
    {
        $this->usersModel = $usersModel;
        $this->renderer = $renderer;
    }

    public function __invoke($request, $response, $args)
    {

        $data = $request->getParsedBody();
        $email = trim($data['email'] ?? '');
        $password = trim($data['password'] ?? '');

        if (empty($email) || empty($password)) {
            $_SESSION['message'] = 'Please enter a valid email and password.';
            return $this->renderer->render($response->withHeader('Location', '/')->withStatus(302), 'index.php');
        }

        $user = $this->usersModel->getUserByEmail($email);

        if($user && password_verify($password, $user['hashedPassword'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['message'] = 'You are now logged in.';
            return $response->withHeader('Location', '/dashboard')->withStatus(302);
        } else {
            $_SESSION['message'] = 'Invalid login.';
            return $response->withHeader('Location', '/')->withStatus(302);
        }
    }
}