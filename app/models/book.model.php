<?php

class BookModel {
    private $db;

    function __construct() {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        $charset = DB_CHARSET;

        $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass);
    }


//MIEMBRO B - BUSCAR LIBROS POR ID.

    function getBookByID($bookId) {
        $query = $this->db->prepare('SELECT * FROM books WHERE id_book = ?');
        $query->execute([$bookId]);
 
        $book = $query->fetch(PDO::FETCH_OBJ);

        return $book; // Retorna el libro encontrado o null si no se encuentra
    }

    function addBook($title, $publication_date, $id_author, $synopsis) {
        $query = $this->db->prepare('INSERT INTO books (title, publication_date, id_author, synopsis) VALUES (?,?,?,?)');
        $query->execute([$title, $publication_date, $id_author, $synopsis]);

        return $this->db->lastInsertId();
    }

}