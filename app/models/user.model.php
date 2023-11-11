<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=" . MYSQL_CHARSET, MYSQL_USER, MYSQL_PASS);
    }

    public function getByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM users WHERE user = ?');
        $query->execute(array($username));

        return $query->fetch(PDO::FETCH_OBJ);
    }
}