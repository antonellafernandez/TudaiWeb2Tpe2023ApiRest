<?php
require_once 'app/models/model.php';

class BookModel extends Model {
    function getBooks($sort_by, $order, $limit, $offset) {
        $query = $this->db->prepare("SELECT * FROM books ORDER BY $sort_by $order LIMIT $limit OFFSET $offset");
        $query->execute();

        $books = $query->fetchAll(PDO::FETCH_OBJ);

        return $books;
    }

    function getBookByID($bookId) {
        $query = $this->db->prepare("SELECT * FROM books WHERE id_book = ?");
        $query->execute([$bookId]);
 
        $book = $query->fetch(PDO::FETCH_OBJ);

        return $book;
    }

    function getByAuthor($idAuthor) {
        $query = $this->db->prepare("SELECT * FROM books WHERE id_author = ?");
        $query->execute([$idAuthor]);

        $books = $query->fetchAll(PDO::FETCH_OBJ);

        return $books;
    }

    function addBook($title, $publication_date, $id_author, $synopsis) {
        $query = $this->db->prepare("INSERT INTO books (title, publication_date, id_author, synopsis) VALUES (?,?,?,?)");
        $query->execute([$title, $publication_date, $id_author, $synopsis]);

        return $this->db->lastInsertId();
    }

    function updateBookData($id, $title, $publication_date, $id_author, $synopsis) {
        $query = $this->db->prepare("UPDATE books SET title = ?, publication_date = ?, id_author = ?, synopsis = ? WHERE id_book = ?");
        $query->execute([$title, $publication_date, $id_author, $synopsis, $id]);
    }
}