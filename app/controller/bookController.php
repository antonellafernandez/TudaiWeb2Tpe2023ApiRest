<?php
require_once './app/model/bookModel.php';
require_once './app/view/bookView.php';

class bookController {

    private $model;
    private $view;

    private $data; 
    
    public function __construct() {
        $this->model = new bookModel();
        $this->view = new bookView();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    



    //MIEMBRO B 

    public function getBookByID($params = null) {
        $id = $params[':ID']; // obtengo el id del arreglo de params
        $book = $this->model->getBookByID($id);

        if ($book) { 
            $this->view->response($book);
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
