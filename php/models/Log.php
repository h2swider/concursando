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
        file_put_contents(ROOT . '/logs/error.txt', "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "] " . json_encode($data) . "\n", FILE_APPEND);
    }

    public static function form($data) {
        file_put_contents(ROOT . '/logs/register_form.txt', "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "] " . json_encode($data) . "\n", FILE_APPEND);
    }

    public static function base($data) {
        file_put_contents(ROOT . '/logs/db.txt', "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "] " . json_encode($data) . "\n", FILE_APPEND);
    }

    public static function confirmacionMail($data) {
        file_put_contents(ROOT . '/logs/invalid-token.txt', "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "] " . json_encode($data) . "\n", FILE_APPEND);
    }

    public static function userLogin($data) {
        file_put_contents(ROOT . '/logs/user-login.txt', "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "] " . json_encode($data) . "\n", FILE_APPEND);
    }

    public static function recovery($data) {
        file_put_contents(ROOT . '/logs/recovery.txt', "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "] " . json_encode($data) . "\n", FILE_APPEND);
    }

    public static function devMail($data) {
        file_put_contents(ROOT . '/logs/dev_mail.txt', "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "] " . json_encode($data) . "\n", FILE_APPEND);
    }

}
