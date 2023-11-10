<?php

require_once("./libs/Route.php");
require_once("./app/controller/bookController.php");

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

// recurso solicitado
$resource = $_GET["resource"];

// método utilizado
$method = $_SERVER["REQUEST_METHOD"];

// instancia el router
$router = new Router();

// arma la tabla de ruteo
$router->addRoute("/libros/:ID", "GET", "bookController", "getBookById");
$router->addRoute("/libros", "POST", "bookController", "addBook");

// rutea
$router->route($resource, $method);
