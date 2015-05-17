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
        ;
    }

    public static function registro($to) {
        
        var_dump($to);
        $headers = 'From: registro@concursando.com.ar' . " " .
                'Reply-To: registro@concursando.com.ar' . " ";

        //mail($to, 'Este es el asunto', 'Este es el mensaje', $headers, '-fuser@yourdomain.com');
        var_dump(mail($to, 'Este es el asunto', 'Este es el mensaje', $headers/*, '-fuser@yourdomain.com'*/));
    }

}
