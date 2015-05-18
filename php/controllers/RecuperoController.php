<?php class RecuperoController extends Controller { 
	
	public function __construct() {
        parent::__construct();
    }
	
	public function main() {
		
	}

	public function recovery() {
		parent::cargarVista("header.php");
		parent::cargarVista("recuperar_clave.php");
		parent::cargarVista("footer.php", get_class());
	}
	
	public function send($data = null) {
		if (!parent::validarEmail($data['post']['email'])) {
			$user = new UserModel();
			$userID = $user->existsEmail($data['post']['email']);
			if ($userID) {
				$token = $user->recovery($userID);
				Mail::registro($data['post']['email'], $userID."-".$token);
			} else {
				header("Location: /recuperar-clave/");
				exit;
			}
		} else {
			header("Location: /recuperar-clave/");
		}
	}

}