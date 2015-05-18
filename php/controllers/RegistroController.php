<?php

class RegistroController extends Controller {

    private $errors = array();

    public function __construct() {
        parent::__construct();
    }

    public function main($data = null) {
        $paises = new PaisModel();
        $data['paises'] = $paises->getPaises();
        parent::cargarVista('header.php');
        parent::cargarVista('form_registro.php', $data);
        parent::cargarVista('footer.php', get_class());
    }

    public function procesarRegistro($data = '') {
        $this->error[] = parent::validarEmail($data['post']['email']);
        $this->error[] = parent::validarPassword($data['post']['password']);
        $this->error[] = parent::validarRequerido($data['post']['email'], "email");
        $this->error[] = parent::validarRequerido($data['post']['password'], "password");
        $this->error[] = parent::validarRequerido($data['post']['nombre'], "nombre");
        $this->error[] = parent::validarRequerido($data['post']['apellido'], "apellido");
        $this->error[] = parent::validarRequerido($data['post']['fecha_nacimiento'], "fecha_nacimiento");
        $this->error[] = parent::validarFechaNacimiento($data['post']['fecha_nacimiento']);
        $this->error[] = parent::validarLargo($data['post']['email'], 'email', 100);
        $this->error[] = parent::validarLargo($data['post']['nombre'], 'nombre', 45);
        $this->error[] = parent::validarLargo($data['post']['apellido'], 'apellido', 45);
        $this->error[] = parent::validarString($data['post']['nombre'], 'nombre');
        $this->error[] = parent::validarString($data['post']['apellido'], 'apellido');
        $this->error[] = parent::validarClaves(md5($data['post']['password'] . SALT), md5($data['post']['password2'] . SALT));

        if (in_array(true, $this->error)) {
            $this->main($data);
        } else {
            $this->registrarUsuario($data);
        }
    }

    public function validarUsuario($data) {
        $usuario = new UserModel();
        echo json_encode(!$usuario->existsEmail($data['post']['email']));
    }

    public function errorRegistro() {
        $this->main();
    }

    public function sucess($data) {
        $data['msg'] = 'Su cuenta <strong>'.$data['url'].'</strong> fue creada con exito, el siguiente paso es confirmar el mail.';  
        parent::cargarVista('header.php');
        parent::cargarVista('form_login.php', $data);
        parent::cargarVista('footer.php', get_class());
    }

    public function registrarUsuario($data) {
        $usuario = new UserModel();
        $estado = new EstadoModel();
        $data['post']['f_alta'] = date('Y-m-d H:i:s');
        $data['post']['password'] = md5($data['post']['password'] . SALT);
        $userID = $usuario->guardarUsuario($data['post']);
        $estadoID = $estado->insertUsuarioEstado($userID, EstadoModel::CONFIRMAR);
        if ($userID && $estadoID) {
            Mail::registro($data['post']['email'], $userID . "-" . md5($data['post']['f_alta'] . SALT));
            header("Location: /registro/exito/{$data['post']['email']}");
            exit;
        } else {
            header("Location: /registro/error-registro");
            exit;
        }
    }
    
    public function confirm($data) {
        $estado = new EstadoModel();
        $id_usuario = $estado->confirmarUsuario($data['url']);
        if ($id_usuario) {
            $estado->insertUsuarioEstado($id_usuario, EstadoModel::HABILITADO);
            header("Location: /login/cuenta-confirmada");
            exit;
        } else {
           header("Location: /login/error-confirmar");
            exit;
        }
        
    }

}
