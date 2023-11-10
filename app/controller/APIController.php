<?php
require_once './app/view/bookView.php';

  abstract class APIController {

        protected $model;
        protected $view;

        private $data; 

        public function __construct() {
            $this->view = new bookView();
            $this->data = file_get_contents("php://input"); 
        }

        function getData() {
            return json_decode($this->data);}

        }