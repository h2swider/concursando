<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mail
 *
 * @author Lucas
 */
class Mail {

    public function __construct() {
        
    }

    public static function registro($to, $token) {

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n" .
                'From: registro@concursando.com.ar' . " " .
                'Reply-To: registro@concursando.com.ar' . " ";

        $asunto = "Confirmar cuenta en Concursando";
        $message = "<html>
<head>
<title>$asunto</title>
</head>
<body>
<p>Haga click en el siguiente enlace para confirmar su cuenta en Concursando <a href='http://concursando.com.ar/usuario/confirmar/$token' alt='Confirmar'>Confirmar</a></p>
</body>
</html>
";

        mail($to, $asunto, $message, $headers);
    }

    public static function recovery($to, $token) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n" .
                'From: recovery@concursando.com.ar' . " " .
                'Reply-To: recovery@concursando.com.ar' . " ";

        $asunto = "Recuperar clave en Concursando";
        $message = "
			<html>
				<head><title>$asunto</title></head>
				<body>
					<p>Haga click en el siguiente enlace para recuperar su clave <a href='http://concursando.com.ar/usuario/cambiar-clave/$token' alt='Recuperar'>Recuperar</a></p>
				</body>
			</html>";
        mail($to, $asunto, $message, $headers);
    }

}
