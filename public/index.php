<?php
ini_set('displaay_errors',1);
ini_set('display_starup_errors',1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cursophp',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
$map->get('index', '/', [
    'cotroller'=>'App\Controllers\indexController',
    'action'=> 'indexAction'
]);
$map->get('addJobs', '/jobs/add', '../addJobs.php');

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);
if(!$route) {
    echo 'No route';

}else{
    $handlerData = $route->handler;
    $controllerName=$handlerData['controller'];
    $actionName= $handlerData['action'];

    $controller= new  $controllerName;
    $controller ->$actionName();

}

