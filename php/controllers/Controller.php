<?php 
	class Controller { 
		public function __construct() {
		
		}
		
		public function cargarVista($url_template) {
			include("../views/".$url_template);
		}
	}
?>