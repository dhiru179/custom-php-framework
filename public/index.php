<?php
// require_once __DIR__.'\vendor\autoload.php';
use app\controller\HomeController;
use app\controller\AuthController;

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
 $configEnv = [
    'db' => [
        'DB_CONNECTION' => $_ENV['DB_CONNECTION'],
        'DB_HOST' => $_ENV['DB_HOST'],
        'DB_PORT' => $_ENV['DB_PORT'],
        'DB_DATABASE' => $_ENV['DB_DATABASE'],
        'DB_USERNAME' => $_ENV['DB_USERNAME'],
        'DB_PASSWORD' => $_ENV['DB_PASSWORD'],
    ],
];


$app = new \app\core\Application(dirname(__dir__),$configEnv);

// $app->router->get("/", [HomeController::class, 'home']);
// $app->router->post("/", [HomeController::class, 'submitData']);
// $app->router->get("/contact", "contact");

// $app->router->get("/login", [AuthController::class, 'login']);
// $app->router->post("/login", [AuthController::class, 'login']);
// $app->router->get("/register", [AuthController::class, 'register']);
// $app->router->post("/register", [AuthController::class, 'register']);
// echo $app->response->setStatusCode(404);
$app->db->applyMigrations();
// $app->run();
