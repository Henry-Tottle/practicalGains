<?php
declare(strict_types=1);

use App\Controllers\CoursesAPIController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\UsersController;
use App\Controllers\RegisterUserController;

return function (App $app) {
    $container = $app->getContainer();

    //demo code - two ways of linking urls to functionality, either via anon function or linking to a controller

    $app->get('/', function ($request, $response, $args) use ($container) {
        $renderer = $container->get(PhpRenderer::class);
        return $renderer->render($response, "index.php", $args);
    });
    $app->get('/register', function ($request, $response) use ($container) {
        $renderer = $container->get(PhpRenderer::class);
        $message = $_SESSION['message'] ?? null;
        return $renderer->render($response, "registration.phtml", ['message'=>$message]);
    });
    $app->post('/register', RegisterUserController::class);

    $app->get('/courses', CoursesAPIController::class);
    $app->get('/users', UsersController::class);

};
