<?php
	function __autoload($nombre_clase) {
		include $nombre_clase . '.php';
	}
?>