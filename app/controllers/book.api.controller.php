<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/book.model.php';

class BookApiController extends ApiController {
    private $model;
    private $authHelper;

    function __construct() {
        parent::__construct();
        $this->authHelper = new AuthHelper();
        $this->model = new BookModel();
    }

    function get($params = []) {
        $user = $this->authHelper->currentUser();

        if (!$user) {
            $this->view->response('Unauthorized.', 401);
            return;
        } else {
            if (empty($params)) {
                $allowed_fields = ['id_book', 'title', 'publication_date', 'id_author', 'synopsis'];
                $sort_by = !empty($_GET['sort_by']) ? $_GET['sort_by'] : "id_book";
                $sort_by = in_array($sort_by, $allowed_fields) ? $sort_by : 'id_book';

                $order = (!empty($_GET['order']) && $_GET['order'] == 1) ? "DESC" : "ASC";

                $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
                $per_page = !empty($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
                $start_index = ($page - 1) * $per_page;

                $limit = intval($per_page);
                $offset = intval($start_index);

                $books = $this->model->getBooks($sort_by, $order, $limit, $offset);

                if ($books) {
                    return $this->view->response($books, 200);
                } else {
                    $this->view->response('El servidor no ha podido interpretar la solicitud.', 500);
                }
            } else if (!empty($params[':ID_A']) && !empty($idAuthor = $params[':ID_A'])) {
                $idAuthor = $params[':ID_A'];
                $booksByAuthor = $this->model->getByAuthor($idAuthor);
                if ($booksByAuthor) {
                    return $this->view->response($booksByAuthor, 200);
                } else {
                    $this->view->response('No se encontraron libros para el autor con id=' . $idAuthor, 404);
                }
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
    }

    function create($params = []) {
        $user = $this->authHelper->currentUser();

        if (!$user) {
            $this->view->response('Unauthorized.', 401);
            return;
        } else {
            $data = $this->getData();

            $id = $this->model->addBook($data->title, $data->publication_date, $data->id_author, $data->synopsis);
            $book = $this->model->getBookByID($id);

            if ($book) {
                $this->view->response($book, 200);
            } else {
                $this->view->response('El libro no ha sido creado.', 500);
            }
        }
    }

    function update($params = []) {
        $user = $this->authHelper->currentUser();

        if (!$user) {
            $this->view->response('Unauthorized.', 401);
            return;
        } else {
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
}