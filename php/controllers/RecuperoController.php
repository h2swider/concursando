<?php

class RecuperoController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main() {
        
    }

    public function recovery() {
        parent::cargarVista("header.php");
		parent::cargarVista('menu.php');
        parent::cargarVista("recuperar_clave.php");
        parent::cargarVista("footer.php", get_class());
    }

    public function send($data = null) {
        if (!parent::validarEmail($data['post']['email'])) {
            $user = new UserModel();
            $recupero = new RecuperoModel();
            $userID = $user->existsEmail($data['post']['email']);
            if ($userID) {
                $token = $recupero->recovery($userID);
                Mail::recovery($data['post']['email'], $userID . "-" . $token);
                header("Location: /recuperar/ok/{$data['post']['email']}");
                exit;
            } else {
                header("Location: /recuperar/invalido");
                exit;
            }
        } else {
            header("Location: /recuperar-clave/");
            exit;
        }
    }
    
    public function invalid($data) {
        $data['msg'] = 'Ingreso un email inválido.';
        parent::cargarVista('header.php');
		parent::cargarVista('menu.php');
        parent::cargarVista('recuperar_clave.php', $data);
        parent::cargarVista('footer.php', get_class());
    }

    public function sendOk($data) {
        $data['msg'] = 'Se envio un mail a <strong>'.$data['url'].'</strong> para recuperar su clave.';
        parent::cargarVista('header.php');
		parent::cargarVista('menu.php');
        parent::cargarVista('form_login.php', $data);
        parent::cargarVista('footer.php', get_class());
    }
    
    public function changePassword($data) {
        
        if(true){ // si es valido el token
        parent::cargarVista('header.php');
		parent::cargarVista('menu.php');
        parent::cargarVista('cambiar_clave.php', $data);
        parent::cargarVista('footer.php', get_class());
        } else {
            
        }
    }

}
