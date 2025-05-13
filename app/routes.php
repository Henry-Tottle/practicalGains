<?php
declare(strict_types=1);

use App\Controllers\LoginUserController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\UsersController;
use App\Controllers\RegisterUserController;
use App\Controllers\GetExercisesByUserID;
use App\Controllers\InsertExerciseController;

return function (App $app) {
    $container = $app->getContainer();

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

    $app->get('/users', UsersController::class);

    $app->get('/dashboard', GetExercisesByUserID::class);

    $app->post('/insertExercise', InsertExerciseController::class);

    $app->post('/logout', function ($request, $response)
    {
        session_destroy();
        return $response->withHeader('Location', '/')->withStatus(302);
    });

};
