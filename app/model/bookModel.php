<?php

class bookModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_library;charset=utf8', 'root', '');
    }


//MIEMBRO B - BUSCAR LIBROS POR ID.

    public function getBookByID($bookId) {
        $query = $this->db->prepare("SELECT * FROM books WHERE id = ?"); 
        $query->execute([$bookId]);

        $book = $query->fetch(PDO::FETCH_OBJ);

        return $book; // Retorna el libro encontrado o null si no se encuentra
    }

    public function saveBook($title, $publication_date, $id_author, $synopsis) {
        $query = $this->db->prepare('INSERT INTO books(title, publication_date, id_author, synopsis) VALUES(?,?,?,0)');
        $query->execute([$title, $publication_date, $id_author, $synopsis]); 
        
        return $this->db->lastInsertId();
    }

}