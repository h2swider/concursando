<?php

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main($data = null) {
        parent::cargarVista("header.php");
        parent::cargarVista("form_login.php", $data);
        parent::cargarVista("footer.php", get_class());
    }

    public function confirmedAcount() {
        $data['confirmed'] = "La cuenta fue confirmada satisfactoriamente, ya puede ingresar al sistema";
        $this->main($data);
    }
    
    public function errorConfirm() {
        $data['error'] = "El link ingresado no es válido";
        $this->main($data);
    }

    public function login($data) {
        $this->error[] = parent::validarEmail($data['post']['email']);
        $this->error[] = parent::validarRequerido($data['post']['password'], "password");
        parent::cargarVista("header.php");
        if (!in_array(true, $this->error)) {
            $user = new UserModel();
            $this->validUser($user, $data['post']['email']);
            $this->userIsActive($user);
            $this->loginUsuario($user, $data);
        } else {
            header("Location: /login/");
            exit;
        }
        parent::cargarVista("footer.php");
    }

    private function validUser($userModel, $email) {
        $userIsValid = $userModel->existsEmail($email);
        if ($userIsValid) {
            return $userIsValid;
        } else {
            header("Location: /login/error-login/invalid-user");
            exit;
        }
    }

    private function userIsActive($userModel) {
        $userIsActive = $userModel->isActive($userModel->getId());
        if ($userIsActive) {
            return $userIsActive;
        } else {
            header("Location: /login/error-login/inactive-user");
            exit;
        }
    }

    private function loginUsuario($userModel, $data = null) {
        $logged_in = $userModel->login($data['post']['email'], $data['post']['password']);
        if ($logged_in) {
            var_dump("Logeado");
        } else {
            header("Location: /login/error-login/error-password?e=" . $data['post']['email']);
            exit;
        }
    }

}
