<?php 
	class Controller { 
		public function __construct() {
		
		}
		
		public function cargarVista($url_template, $data='') {
			require_once("php/config/config.php");
			require("php/views/".$url_template);
		}
	}
?>