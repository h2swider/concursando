<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Log
 *
 * @author u62643
 */
class Log {

    public static function error($data) {

        file_put_contents(ROOT . '/logs/error.txt', json_encode($data)."\n", FILE_APPEND);
    }

}
