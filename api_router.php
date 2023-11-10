<?php

require_once("./libs/Route.php");
require_once("./app/controller/bookController.php");

// instancia el router
$router = new Router();

// arma la tabla de ruteo
$router->addRoute("/libros/:ID", "GET", "bookController", "getBookById");
$router->addRoute("/libros", "POST", "bookController", "addBook");

// rutea
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);;
