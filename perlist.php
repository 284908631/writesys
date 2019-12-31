<?php
	require './lib/init.php';
	checkManage();
	$sql = "select * from per_dept";
	$pers = myGetAll($sql);
	//var_dump($per);
	require PATH.'/view/admin/perlist.html';
?>