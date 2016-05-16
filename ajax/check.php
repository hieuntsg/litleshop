<?php

	session_start();	
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../admin/lib/');
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."function_user.php";
	include_once _lib."class.database.php";
	include_once _lib."file_requick.php";
	include_once _lib.'functions_giohang.php';
	//$d = new database($config['database']);

?>
