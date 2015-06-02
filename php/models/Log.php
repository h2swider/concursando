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

    public function __construct() {
        
    }

    private static function formatData($data) {

        $str = "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "]\n";
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (!is_array($value)) {
                    $str .= "$key: $value\n";
                } else {
                    $str.= "$key: " . json_encode($value) . "\n";
                }
            }
        } else {
            $str.= $data . "\n";
        }
        $str .= "-----------------------------------------------------------------------------\n\n";
        return $str;
    }

    public static function error($data) {
        file_put_contents(ROOT . '/logs/error.txt', self::formatData($data), FILE_APPEND);
    }

    public static function form($data) {
        file_put_contents(ROOT . '/logs/register_form.txt', self::formatData($data), FILE_APPEND);
    }

    public static function base($data) {
        file_put_contents(ROOT . '/logs/db.txt', self::formatData($data), FILE_APPEND);
    }

    public static function confirmacionMail($data) {
        file_put_contents(ROOT . '/logs/invalid-token.txt', self::formatData($data), FILE_APPEND);
    }

    public static function userLogin($data) {
        file_put_contents(ROOT . '/logs/user-login.txt', self::formatData($data), FILE_APPEND);
    }

    public static function recovery($data) {
        file_put_contents(ROOT . '/logs/recovery.txt', self::formatData($data), FILE_APPEND);
    }

    public static function devMail($data) {
        file_put_contents(ROOT . '/logs/dev_mail.txt', self::formatData($data), FILE_APPEND);
    }

}
