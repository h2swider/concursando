<?php

class UsuarioController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main() {
        echo 3;
    }

    public function panelUsuario($data = '') {
        var_dump($data);
    }

    public function confirmar($data) {
        $estado = new EstadoModel();
        $id_usuario = $estado->confirmarUsuario($data['url']);
        parent::cargarVista('header.php');
        if ($id_usuario) {
            $estado->insertUsuarioEstado($id_usuario, EstadoModel::HABILITADO);
            parent::cargarVista('exito_confirmar.php');
        } else {
            parent::cargarVista('token_expirado.php');
        }
        parent::cargarVista('footer.php');
    }

    public function changePassword($data) {
        var_dump($data);
    }

}
