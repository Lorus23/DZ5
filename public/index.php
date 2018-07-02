<?php
use App\Controllers\ImageController;

define('PUBLIC_PATH', getcwd());

define('APPLICATION_PATH', realpath(__DIR__ . '/..') . '/app');
require_once APPLICATION_PATH . "/../vendor/autoload.php";
$routes = explode('/', $_SERVER['REQUEST_URI']);
$controllerName = "Image";
$actionName = "index";

if (sizeof($routes) > 2) {
    list(, $controllerName, $actionName, $parameter) = $routes;
}
try {
    $className = '\App\Controllers\\' . ucfirst($controllerName) . 'Controller';// \App\Posts
    $controller = new $className();
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        throw new Exception('Method not found');
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
