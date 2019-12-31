<?php
	/*获取writesys绝对路径*/
	define('PATH', dirname(__DIR__));
	require PATH.'/lib/mysqli.php';
	require PATH.'/lib/func.php';
	date_default_timezone_set("PRC");
	$_GET = _addslashes($_GET);
	$_POST = _addslashes($_POST);
	$_COOKIE = _addslashes($_COOKIE);
	
?>