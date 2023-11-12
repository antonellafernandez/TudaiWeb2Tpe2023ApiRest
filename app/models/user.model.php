<?php
require_once 'app/models/model.php';

class UserModel extends Model {
    public function getByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM users WHERE user = ?');
        $query->execute(array($username));

        return $query->fetch(PDO::FETCH_OBJ);
    }
}