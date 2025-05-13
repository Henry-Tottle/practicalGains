<?php

namespace App\Controllers;
use App\Models\UsersModel;
use Slim\Views\PhpRenderer;

class RegisterUserController
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
        $data = $request->getParsedBody();
        $name = trim($data['username']) ?? '';
        $email = trim($data['email']) ?? '';
        $password = trim($data['password']) ?? '';
        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['message'] = 'Please fill in all fields';
            return $this->renderer->render($response->withHeader('Location', '/register')->withStatus(302), 'registration.phtml',
                ['message'=>'Please fill out all fields']);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->usersModel->registerUser($name, $email, $hashedPassword);
        $_SESSION['message'] = 'Registration successful';
        return $response->withHeader('Location', '/users')->withStatus(302);


    }
}