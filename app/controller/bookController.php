<?php

require_once './app/model/bookModel.php';
require_once './APIController.php';

class bookController extends APIController { 
    
    public function __construct() {
        parent::__construct();
        $this->model = new bookModel();
    }
    
    //MIEMBRO B 

    public function getBookByID($params = null) {
        $id = $params[':ID']; // obtengo el id del arreglo de params
        $book = $this->model->getBookByID($id);

        if ($book) { 
            $this->view->response($book, 200);
        }
        else {
            $this->view->response("El auto que quieres ver con el id $id no existe", 404);
        }
    }

    public function addBook($params = null) {
        $data = $this->getData();

        $id = $this->model->saveBook($data->title, $data->publication_date, $data->id_author, $data ->synopsis);
        
        $tarea = $this->model->getBookByID($id);
        if ($tarea)
            $this->view->response($tarea, 200);
        else
            $this->view->response("La tarea no fue creada", 500);

    }

    
}
