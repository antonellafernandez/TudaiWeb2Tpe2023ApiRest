<?php
require_once 'libs/Router.php';
require_once './app/controller/bookController.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

// recurso solicitado
$resource = $_GET["resource"];

// método utilizado
$method = $_SERVER["REQUEST_METHOD"];

// instancia el router
$router = new Router();


// define la tabla de ruteo
$router->addRoute('libros/:ID', 'GET', 'bookController', 'getBookById');
$router->addRoute('tareas', 'POST', 'TaskApiController', 'crearTarea');
$router->addRoute('tareas/:ID', 'GET', 'TaskApiController', 'obtenerTarea');

// rutea
$router->route($resource, $method);