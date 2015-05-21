<?php class PanelController extends Controller {
	public function main($data) {
		parent::cargarVista('header.php');
		parent::cargarVista('menu.php');
		parent::cargarVista('panel.php');
		parent::cargarVista('footer.php');
	}
}