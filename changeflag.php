<?php 
	require './lib/init.php';
	if(isset($_GET['xw_id'])&&is_numeric($_GET['xw_id'])){
		$xw_id = $_GET['xw_id'];
		$sql = "update xw set xw_read = 1 where xw_id = ".$xw_id;
		$result = myQuery($sql);
		if(!$result){
			error("收件错误");
		}
		header("location:oldxw.php");
	}
	
	
?>