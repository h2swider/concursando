<?php
	$rutas['main'] = 'RegistroController/main';
	$rutas['registro'] = 'RegistroController/main';
	
	
	// rutas POST
	$rutas['registro/registrar-usuario'] = 'RegistroController/procesarRegistro';
	
	// rutas GET 
	$rutas['usuarios/print-hola'] = 'UsuarioController/printHola';
	
	
	// rutas URL
	$rutas['usuarios/get-usuario/@param'] = 'UsuarioController/panelUsuario'; 
?>