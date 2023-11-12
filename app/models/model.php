<?php

class Model {
    protected $db;

    function __construct() {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=" . MYSQL_CHARSET, MYSQL_USER, MYSQL_PASS);
    }
}