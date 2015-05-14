<?php 
class RegistroController extends Controller { 
	
	public function __construct() {
		
	}
	
	public function main() {
		if (empty($_POST)) {
			parent::cargarVista('header.php');
			parent::cargarVista('form_registro.php');
			parent::cargarVista('footer.php');
		} else {
			$this->procesarRegistro();
		}
	}
	
	
	public function procesarRegistro() {
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			die("Mail incorrecto");
		}
		if (!preg_match('/^[a-f0-9]{32}$/', $_POST['password'])) {
			die("El string no es md5");
		}
		
		echo "Llego todo ok";
		
	}
}

?>