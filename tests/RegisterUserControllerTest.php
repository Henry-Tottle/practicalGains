<?php

namespace Tests;

use App\Controllers\RegisterUserController;
use App\Models\UsersModel;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;

class RegisterUserControllerTest extends \PHPUnit\Framework\TestCase
{
    private UsersModel $model;
    private PhpRenderer  $renderer;
    private RegisterUserController $controller;

    public function setUp(): void
    {
        $this->model = $this->createMock(UsersModel::class);
        $this->renderer = $this->createMock(PhpRenderer::class);
        $this->controller = new RegisterUserController($this->model, $this->renderer);
    }

    public function testValidRegistrationRedirectsToUsers()
    {
        // here I have created a mock request which simulates a real HTTP request
        $request = $this->createMock(ServerRequestInterface::class);
        //I've created a Response object to pass to the controller
        $response = new Response();

        //this tells the controller what the body of the request will be in this instance
        $request->method('getParsedBody')->willReturn([
            'username'=>'Henry',
            'email'=>'henry@henry.com',
            'password'=>'password123'
        ]);

        //Here I am stating that registerUser in my model is called only once
        $this->model->expects($this->once())
            ->method('registerUser')
            //and must be called with the following credentials
            ->with('Henry', 'henry@henry.com', $this->callback(function ($hashedPassword) {
                //this bit checks the third argument dynamically as password hashes change every time
                return password_verify('password123',$hashedPassword);
            }));

        //runs the test
        $result = $this->controller->__invoke($request, $response);


        //results:
        $this->assertEquals(302, $result->getStatusCode());
        $this->assertEquals(['/users'], $result->getHeader('Location'));
    }

    public function testInvalidRegistrationRedirectsToRegisterUsers()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = new Response();

        $request->method('getParsedBody')->willReturn([
            'username'=>'',
            'email'=>'henry@henry.com',
            'password'=>'password123'
        ]);

        $result = $this->controller->__invoke($request, $response);

        $this->assertEquals(302, $result->getStatusCode());
        $this->assertEquals(['/register'], $result->getHeader('Location'));
    }

}