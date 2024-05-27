<?php
require_once __DIR__ . '/vendor/autoload.php';

use Project\Handlers\Contact;
use Project\Handlers\User;

use Project\Classes\Router;

$router = new Router();

$router->get('/', fn() => require_once __DIR__ . '/views/main.php');
    /*
    require_once ('./views/header.html');

    if( isset( $_SESSION['TOKEN']) && isset($_SESSION['username']) )
        echo '<div class="container"><h1>Home page - '. $_SESSION['username'] .'</h1></div>';
    else
        echo '<div class="container"><h1>Home page</h1></div>';

    require_once ('./views/footer.html');
    */

$router->get('/users', fn() => require_once('./views/users.php'));

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

$router->get('/login', User::class . '::loginPage');
$router->post('/login', fn() => User::login() );

$router->get('/register', User::class . '::registerPage');
$router->post('/register', fn() => User::register() );

$router->get('/user', User::class . '::userPage');
$router->post('/user', User::class . '::update');

$router->get('/logout', User::class . '::logout');

$router->run();