<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/envloader.php';

session_start();

use Project\Handlers\User;

use Project\Classes\Router;

$router = new Router();

$router->get('/', fn() => require_once __DIR__ . '/views/main.php');

$router->get('/users', fn() => require_once('./views/users.php'));

$router->addNotFoundHandler(function () {
    $title = "Not Found!";
    require_once __DIR__ . '/views/404.php';
});

$router->get('/login', User::class . '::loginPage');
$router->post('/login', fn() => User::login() );

$router->get('/register', User::class . '::registerPage');
$router->post('/register', fn() => User::register() );

$router->get('/user', User::class . '::userPage');
$router->post('/user', User::class . '::update');

$router->get('/logout', User::class . '::logout');

$router->run();
