<?php
declare(strict_types=1);

use App\Controllers\CoursesAPIController;
use App\Controllers\LoginUserController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\UsersController;
use App\Controllers\RegisterUserController;

return function (App $app) {
    $container = $app->getContainer();

    //demo code - two ways of linking urls to functionality, either via anon function or linking to a controller

    $app->get('/', function ($request, $response, $args) use ($container)
    {
        $renderer = $container->get(PhpRenderer::class);
        return $renderer->render($response, "index.php", $args);
    });
    $app->get('/register', function ($request, $response) use ($container)
    {
        $renderer = $container->get(PhpRenderer::class);
        $message = $_SESSION['message'] ?? null;
        return $renderer->render($response, "registration.phtml", ['message' => $message]);
    });
    $app->post('/register', RegisterUserController::class);

    $app->post('/login', LoginUserController::class);
    // check this route and delete soon as it was part of skeleton
    $app->get('/courses', CoursesAPIController::class);

    $app->get('/users', UsersController::class);

    $app->get('/dashboard', function ($request, $response, $args) use ($container)
    {
        $renderer = $container->get(PhpRenderer::class);
        if (!isset($_SESSION['user_id']))
        {
            $_SESSION['message'] = "You must be logged in to access this page!";
            return $response->withHeader('Location', '/')->withStatus(302);
        }
        return $renderer->render($response, "dashboard.phtml", $args);
    });

    $app->post('/logout', function ($request, $response)
    {
        session_destroy();
        return $response->withHeader('Location', '/')->withStatus(302);
    });

};
