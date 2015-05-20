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
    
    public function __construct(){
        
    }
    
    private function formatData($data){
        
        $str = "[" . date('Y-m-d H:i:s') . " / " . $_SERVER['REMOTE_ADDR'] . "]\n";
        foreach($data as $key => $value){
            $str .= "$key: $value\n";
        }
        $str .= "-----------------------------------------------------------------------------\n\n";
        return $str;
    }
    
    public static function error($data) {
        file_put_contents(ROOT . '/logs/error.txt', $this->form($data), FILE_APPEND);
    }

    public static function form($data) {
        file_put_contents(ROOT . '/logs/register_form.txt', $this->form($data), FILE_APPEND);
    }

    public static function base($data) {
        file_put_contents(ROOT . '/logs/db.txt', $this->form($data), FILE_APPEND);
    }

    public static function confirmacionMail($data) {
        file_put_contents(ROOT . '/logs/invalid-token.txt', $this->form($data), FILE_APPEND);
    }

    public static function userLogin($data) {
        file_put_contents(ROOT . '/logs/user-login.txt', $this->form($data), FILE_APPEND);
    }

    public static function recovery($data) {
        file_put_contents(ROOT . '/logs/recovery.txt', $this->form($data), FILE_APPEND);
    }

    public static function devMail($data) {
        file_put_contents(ROOT . '/logs/dev_mail.txt', $this->form($data), FILE_APPEND);
    }

}
