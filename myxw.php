<?php
	require './lib/init.php';
	checkCookie();
	$dept_id = $_COOKIE['username'];
	
	//获取查找
	if(isset($_GET['search'])){
		$title = "'%".$_GET['search']."%'";
		$search_flag = true;
		//echo $title;
	}else{
		$title = "'%'";
		$search_flag = false;
	}

	//获取行文筛选
	if(isset($_GET['xw_flag'])&&is_numeric($_GET['xw_flag'])){
		$xw_flag = $_GET['xw_flag'];
	}

	//var_dump(empty($xw_flag));

	//获取用户的行文
	$sql = "select * from xw,dept where xw_auther = $dept_id and xw.xw_to = dept.dept_id and xw_title like ".$title;
	if(isset($xw_flag)){
		$sql .= " and xw_flag = ".$xw_flag;
	}

	$sql .= " order by xw_id desc";
	$xws = myGetAll($sql);
	
	//获取页码信息
    $sum = count($xws);
    //var_dump($xws);
    $cnt = 3;
    $sumPages = ceil($sum/$cnt);
	
    //获取页码
    if(isset($_GET['curr'])&&is_numeric($_GET['curr'])&&$_GET['curr']<=$sumPages&&$_GET['curr']>0){
		$curr = $_GET['curr'];
	}else{
		$curr = 1;
	}
	$pages = getPages($sum, $curr, $cnt);
	//var_dump($pages);
	
	require PATH.'/view/admin/myxw.html';
?>