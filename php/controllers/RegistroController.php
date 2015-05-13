<?php 
include("Controller.php");
class RegistroController extends Controller { 
	public function __construct() {
		
	}
	
	public function cargarTemplate() {
		parent::cargarVista('header.php');
		parent::cargarVista('form_registro.php');
		parent::cargarVista('footer.php');
	}
	
	public function procesarRegistro() {
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			die("Mail incorrecto");
		}
	}
}
$rc = new RegistroController();

if (empty($_POST)) {
	$rc->cargarTemplate();
} else {
	$rc->procesarRegistro();
}
?>