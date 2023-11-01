<?php
require_once './app/model/bookModel.php';
require_once './app/view/bookView.php';

class bookController {

    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new bookModel();
        $this->view = new bookView();
    }


    //MIEMBRO B - OBTENER LIBRO POR ID

    public function getBookByID($params = null) {
        // Obtiene el parámetro de la ruta
        $id = isset($params[':ID']) ? $params[':ID'] : null;
        
        if (!$id) {
            $this->view->response("ID de tarea no válido", 400);
        }
    
        $tarea = $this->model->getBookByID($id);
        
        if ($tarea) {
            $this->view->response($tarea, 200);   
        } else {
            $this->view->response("No existe la tarea con el id={$id}", 404);
        }
    }
    
}
