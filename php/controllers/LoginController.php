<?php

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main($data = null) {

        parent::cargarVista("header.php");
        parent::cargarVista("menu.php");
        if (isset($_SESSION['userdata'])) {
            header("location:/panel");
            exit;
        } else {
            parent::cargarVista("form_login.php", $data);
        }
        parent::cargarVista("footer.php", get_class());
    }

    public function confirmedAcount($data = null) {
        $data['confirmed'] = "La cuenta fue confirmada satisfactoriamente, ya puede ingresar al sistema";
        $this->main($data);
    }

    public function errorConfirm($data = null) {
        $data['error'] = "El link ingresado no es válido";
        $this->main($data);
    }

    public function errorChangePass($data = null) {
        $data['error'] = "El link ingresado no es válido";
        $this->main($data);
    }

    public function passChanged($data = null) {
        $data['confirmed'] = 'La clave fue actualizada con exito';
        $this->main($data);
    }

    public function login($data) {
        $this->error[] = parent::validarEmail($data['post']['email']);
        $this->error[] = parent::validarRequerido($data['post']['password'], "password");
        if (!in_array(true, $this->error)) {
            $user = new UserModel();
            $this->validUser($user, $data['post']['email']);
            $this->userIsActive($user);
            $this->loginUsuario($user, $data);
        } else {
            header("Location: /login/");
            exit;
        }
    }

    private function validUser(UserModel $userModel, $email) {
        $userIsValid = $userModel->existsEmail($email);
        if ($userIsValid) {
            return $userIsValid;
        } else {
            header("Location: /login/error-login/invalid-user");
            exit;
        }
    }

    private function userIsActive(UserModel $userModel) {
        $userIsActive = $userModel->isActive($userModel->getId());
        if ($userIsActive) {
            return $userIsActive;
        } else {
            header("Location: /login/error-login/inactive-user");
            exit;
        }
    }

    private function loginUsuario(UserModel $userModel, $data = null) {
        $logged_in = $userModel->login($data['post']['email'], $data['post']['password']);
        if ($logged_in) {
            $_SESSION['userdata'] = $logged_in;
            header("Location: /panel/");
            exit;
        } else {
            header("Location: /login/error-login/error-password");
            exit;
        }
    }

    public function logout($data) {
        session_destroy();
        header("Location: /");
        exit;
    }

}
