<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/user.model.php';

class UserApiController extends ApiController {
    private $model;
    private $authHelper;

    function __construct() {
        parent::__construct();
        $this->authHelper = new AuthHelper();
        $this->model = new UserModel();
    }

    function getToken($params = []) {
        $basic = $this->authHelper->getAuthHeaders(); // Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'

        if (empty($basic)) {
            $this->view->response('Los encabezados de autenticación no han sido enviados.', 401);
            return;
        }

        $basic = explode(" ", $basic); // ["Basic", "base64(usr:pass)"]

        if ($basic[0] != "Basic") {
            $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
            return;
        }

        $userpass = base64_decode($basic[1]); // usr:pass
        $userpass = explode(":", $userpass); // ["usr", "pass"]

        $user = $userpass[0];
        $pass = $userpass[1];

        $userdata = $this->model->getByUsername($user);

        if ($userdata) {
            if (password_verify($pass, $userdata['password'])) {
                $token = $this->authHelper->createToken($userdata);
                $this->view->response($token);
            } else {
                $this->view->response('Contraseña incorrecta.', 401);
            }
        } else {
            $this->view->response('Usuario incorrecto.', 401);
        }
    }
}