<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/book.model.php';

class BookApiController extends ApiController {
    private $model;

    function __construct() {
        parent::__construct();
        $this->model = new BookModel();
    }
    
    //MIEMBRO B 

    function getBookByID($params = []) {
        $id = $params[':ID']; // Obtengo el id del arreglo de params
        $book = $this->model->getBookByID($id);

        if ($book) { 
            $this->view->response($book, 200);
        } else {
            $this->view->response("El libro con id $id no existe", 404);
        }
    }

    function addBook($params = []) {
        $data = $this->getData();

        $id = $this->model->addBook($data->title, $data->publication_date, $data->id_author, $data->synopsis);
        $book = $this->model->getBookByID($id);

        if ($book) {
            $this->view->response($book, 200);
        } else {
            $this->view->response("El libro no ha sido creado", 500);
        }
    }
}