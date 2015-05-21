<?php class IndexController extends Controller {
	
	public function main($data = null) {
		parent::cargarVista('header.php');
		parent::cargarVista('menu.php');
        parent::cargarVista('index.php', $data);
        parent::cargarVista('footer.php', get_class());
	}
}