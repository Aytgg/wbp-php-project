<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/envloader.php';

// use Project\Handlers\Contact;
use Project\Handlers\User;

use Project\Classes\Router;

$router = new Router();

$router->get($_ENV['BASE_PATH'] . '/', fn() => require_once __DIR__ . '/views/main.php');
    /*
    require_once ('./views/header.html');

    if( isset( $_SESSION['TOKEN']) && isset($_SESSION['username']) )
        echo '<div class="container"><h1>Home page - '. $_SESSION['username'] .'</h1></div>';
    else
        echo '<div class="container"><h1>Home page</h1></div>';

    require_once ('./views/footer.html');
    */

$router->get($_ENV['BASE_PATH'] . '/users', fn() => require_once('./views/users.php'));

/*$router->get('/about', function (array $params = []) {
    include_once ('./views/header.html');
    echo '<div class="container"><h1>About page</h1></div>';
    include_once ('./views/footer.html');

    if (!empty ($params['name']))
        echo '<h1> Hello ' . $params['name'] . '</h1>';
});

$router->get('/contact', Contact::class . '::execute');
$router->post('/contact', function ($params) {
    var_dump($params);
});*/

$router->addNotFoundHandler(function () {
    $title = "Not Found!";
    require_once __DIR__ . '/views/404.php';
});

$router->get($_ENV['BASE_PATH'] . '/login', User::class . '::loginPage');
$router->post($_ENV['BASE_PATH'] . '/login', fn() => User::login() );

$router->get($_ENV['BASE_PATH'] . '/register', User::class . '::registerPage');
$router->post($_ENV['BASE_PATH'] . '/register', fn() => User::register() );

$router->get($_ENV['BASE_PATH'] . '/user', User::class . '::userPage');
$router->post($_ENV['BASE_PATH'] . '/user', User::class . '::update');

$router->get($_ENV['BASE_PATH'] . '/logout', User::class . '::logout');

$router->run();