<?php

require_once 'config.php';
require_once 'libs/router.php';

require_once 'app/controllers/book.api.controller.php';

// Instanciar router
$router = new Router();

#                 Endpoint      Verbo     Controller           Método
$router->addRoute('libros/:ID', 'GET',    'BookApiController', 'getBookByID');
$router->addRoute('libros',     'POST',   'BookApiController', 'addBook');

# htaccess resource=(), llamar a GET/POST/PUT/...
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);