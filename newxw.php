<?php
	require './lib/init.php';
	checkCookie();
	$id = $_COOKIE['username'];

	//获取查找
	if(isset($_GET['search'])){
		$title = "%".$_GET['search']."%";
		$search_flag = true;
		//echo $title;
	}else{
		$title = '%';
		$search_flag = false;
	}

	/*获取行文总数,废话连篇*/
	if(!empty($_GET['dept_id'])){
		$dept_id = $_GET['dept_id'];
		$where = "and dept.dept_id = $dept_id";
		//$where = "and xw_auther =  $dept_id";
	}else{
		$where = "";
	}
	//$sql = "select count(*) from xw where xw_to = $id and xw_flag = 1 and xw_read = 0 ".$where." and xw_title like '".$title."' order by xw_id desc";
	//var_dump(myGetOne($sql));
	   //获取已经发布的，发到该账号的行文
	$sql = "select count(*) from xw,dept where xw_to = $id and xw_flag = 1 and dept.dept_id = xw.xw_auther and xw.xw_read = 0 ".$where." and xw_title like '".$title."' order by xw_id desc";
	
	$sum = myGetOne($sql);
	/*废话结束*/

	//每页多少条
	$cnt = 3;
	//获取总页数
	$sumPages = ceil($sum/$cnt);

	//获取页码
	if(isset($_GET['curr'])&&is_numeric($_GET['curr'])&&$_GET['curr']<=$sumPages&&$_GET['curr']>0){
		$curr = $_GET['curr'];
	}else{
		$curr = 1;
	}

	//获取筛选部门
	if(!empty($_GET['dept_id'])){
		$dept_id = $_GET['dept_id'];
		$where = "and dept.dept_id = $dept_id";
		//$where = "and xw_auther =  $dept_id";
	}else{
		$where = "";
	}

	//添加查询限制条件
	$limit =' limit '.($curr-1)*$cnt.','.$cnt;

	//获取已经发布的，发到该账号的行文
	$sql = "select * from xw,dept where xw_to = $id and xw_flag = 1 and dept.dept_id = xw.xw_auther and xw.xw_read = 0 ".$where." and xw_title like '".$title."' order by xw_id desc".$limit;
	
	$xws = myGetAll($sql);
	
	//获取部门类型
	$depts = getDepts();

	//获取页码
	$pages = getPages($sum,$curr,$cnt);
	
	require './view/admin/newxw.html';
?>