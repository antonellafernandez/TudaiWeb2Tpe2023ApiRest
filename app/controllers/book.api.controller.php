<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/book.model.php';

class BookApiController extends ApiController {
    private $model;

    function __construct() {
        parent::__construct();
        $this->model = new BookModel();
    }

    function get($params = []) {
        if (empty($params)) {
            $tareas = $this->model->getBooks();
            return $this->view->response($tareas, 200);
        } else {
            $id = $params[':ID'];
            $book = $this->model->getBookByID($id);

            if ($book) {
                $this->view->response($book, 200);
            } else {
                $this->view->response('El libro con id=' . $id . ' no existe.', 404);
            }
        }
    }

    function create($params = []) {
        $data = $this->getData();

        $id = $this->model->addBook($data->title, $data->publication_date, $data->id_author, $data->synopsis);
        $book = $this->model->getBookByID($id);

        if ($book) {
            $this->view->response($book, 200);
        } else {
            $this->view->response('El libro no ha sido creado.', 500);
        }
    }

    function update($params = []) {
        $id = $params[':ID'];
        $book = $this->model->getBookByID($id);

        if ($book) {
            $data = $this->getData();

            $this->model->updateBookData($id, $data->title, $data->publication_date, $data->id_author, $data->synopsis);
            $this->view->response('El libro con id=' . $id . ' ha sido modificado.', 200);
        } else {
            $this->view->response('El libro con id=' . $id . ' no existe.', 404);
        }
    }
}