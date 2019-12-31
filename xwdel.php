<?php
	require './lib/init.php';
	$xw_id = htmlspecialchars($_GET['xw_id']);
	$sql = "delete from xw where xw_id = $xw_id";
	$result = myQuery($sql);
	if(!$result){
		error("删除失败");
	}
	else{
		header("location:myxw.php");
	}
?>