<?php
if (!isset($_SESSION)) {
	session_start();
}

define('ENTORNO', 'DEV');
define('SALT', 'c0ncurs4nd0!');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define("ASSETS_PATH", '/assets/');
define("CONTROLLERS_PATH", ROOT.'/php/controllers/');
define("MODELS_PATH", ROOT.'/php/models/');
define("VIEWS_PATH", ROOT.'/php/views/');
define("CONFIG_PATH", ROOT.'/php/config/');
function custom_error_handler($error_number, $error_string, $error_file, $error_line, $error_context) {
	require_once(MODELS_PATH.'Log.php');
	$data_error['file'] = $error_file;
	$data_error['line'] = $error_line;
	$data_error['context'] = $error_context;
	$data_error['message'] = $error_string;
	$data_error['errno'] = $error_number;
	Log::error($data_error);
}
set_error_handler("custom_error_handler", E_ALL);