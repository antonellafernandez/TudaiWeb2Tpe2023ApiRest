<?php

require_once 'config.php';
require_once 'libs/router.php';

require_once 'app/controllers/book.api.controller.php';

// Instanciar router
$router = new Router();

#                 Endpoint      Verbo     Controller           Método
$router->addRoute('libros',     'GET',    'BookApiController', 'get');
$router->addRoute('libros/:ID', 'GET',    'BookApiController', 'get');
$router->addRoute('libros',     'POST',   'BookApiController', 'create');
$router->addRoute('libros/:ID', 'PUT',    'BookApiController', 'update');

# htaccess resource=(), llamar a GET/POST/PUT/...
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);