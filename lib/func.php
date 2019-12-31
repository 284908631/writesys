<?php

	/**
	 *提示成功函数
	 * @param  string $str [description]
	 * @return [type]      [description]
	 */
	function succ($str = '成功'){
		$sign = 'succ';
		require PATH.'/view/admin/info.html';
		exit();
	}

	/**
	 * 提示失败函数
	 */
	function error($str='失败'){
		$sign = 'error';
		require PATH.'/view/admin/info.html';
		exit();
	}

	/**
	 * 获取用户ip地址
	 * @return $ip 用户ip
	 */
	function getIp(){
		if(getenv('REMOTE_ADDR')){
			return getenv('REMOTE_ADDR');
		}else if(getenv('HTTP_CLIENT_IP')){
			return getenv('HTTP_CLIENT_IP');
		}else if(getenv('HTTP_X_FORWARDED_FOR')){
			return getenv('HTTP_X_FORWARDED_FOR');
		}else{
			return false;
		}
	}

	/**
	 * 获取共五页的分页
	 * @param  integer  $sum 	总数据行数
	 * @param  integer  $curr 	当前页数
	 * @param  integer  $cnt  	每页多少行数据
	 * @return array    $pages 	返回当前页数的附近页数，共5页，键为页数，值为$_GET参数中的? &
	 */
	function getPages($sum,$curr,$cnt=2){
		//echo "<br>".$cnt."<br>";
		//总页数
		$max = ceil($sum/$cnt);
		//左边
		$left = max($curr-2, 1);
		//右边
		$right = $left + 4;
		$right = min($right, $max);
		$left = max($right-4, 1);
		$pages = array();
		for ($i=$left; $i <= $right; $i++) { 
			//curr = i
			$_GET['curr'] = $i;
			//page => { 1=>curr=1&cat_id=1 }
			$pages[$i] = http_build_query($_GET);
		}
		return $pages;
	}

	/**
	 * 生成随机字符串
	 * @param  integer $length 需要获取的长度
	 * @return String  随机的字符串
	 */
	function randString($length=6){
		$str = str_shuffle('abcdefghjklmnprstuvwsyz2345678ABCDEFGHJKLMNPQRSTUVWSYZ');
		return substr($str, 0, $length);
	}

	/**
	 * 按照日期创建存储目录
	 * @return String $path 相对路径 创建是绝对路径
	 */
	function createDir(){
		$path = '/upload/'.date('Y/md');
		$absPath = PATH.$path;
		if(is_dir($absPath) || mkdir($absPath,0777,true)){
			return $path;
		}
		else
			return false;
	}

	/**
	 * 获取文件后缀名
	 * @param  String $name 需要获取后缀名的文件名
	 * @return String 后缀名
	 */
	function getExt($fileName){
		return strrchr($fileName, '.');
	}

	/**
	 * 获取使用salt加密后的字符串
	 * @param  string $str 
	 * @return string $str   加密后的字符串
	 */
	function cCode($str){
		$arr = require 'config.php';
		$salt = $arr['salt'];
		return $str = md5($str.$salt);
	}
	
	/**
	 * 检查是否登录，未登录则返回登录界面
	 */
	function checkCookie(){
		
		if(!isset($_COOKIE['username'])||!isset($_COOKIE['salt'])){
			header('location:login.php');
		}else{
			$username = $_COOKIE['username'];
			$salt = $_COOKIE['salt'];
			if($salt !=cCode($username)){
				header('location:login.php');
			}
		}
	}

	/**
	 *	检查管理员登录状态，未登录则返回管理员登录界面
	 */
	function checkManage(){
		if(!isset($_COOKIE['_user'])||!isset($_COOKIE['_salt'])){
			header("location:managelogin.php");
		}else{
			$_user = $_COOKIE['_user'];
			$_salt = $_COOKIE['_salt'];
			if($_salt !=cCode($_user)){
				header("location:managelogin.php");
			}
		}
	}
	
	/**
	 * 对数据进行转义
	 * @param  array $arr 需要转义的数组
	 * @return array $arr 转义后的数组
	 */
	function _addslashes($arr){
		foreach($arr as $k =>$v){
			if(is_string($v)){
				$arr[$k] = addslashes($v);
			}else if(is_array($v)){
				$arr[$k] = _addslashes($v);
			}
		}
		return $arr;
	}

	/**
	 * 	获取所有部门
	 *	@return array $depts 所有部门
	 *
	 */
	function getDepts(){
		//获取部门类型
		$sql = "select * from dept";
		$depts = myGetAll($sql);
		if(!$depts){
			error("获取部门失败");
		}
		return $depts;
	}

	/**
	 * 获取当前登录用户的部门
	 *	
	 *	@return String $dept_name 当前登录用户的部门名
	 *
	 */
	function getMyDept(){
		checkCookie();
		$dept_id = $_COOKIE['username'];
		$sql = "select dept_name from dept where dept_id = $dept_id";
		$dept_name = myGetOne($sql);
		if(!$dept_name){
			error("获取部门失败");
		}
		return $dept_name;
	}

	/**
	 * 获取所需用户的部门
	 *	@param int $dept_id 部门id
	 *	@return String $dept_name 所查用户的部门名
	 *
	 */
	function getDeptName($dept_id){
		$sql = "select dept_name from dept where dept_id=".$dept_id;
		$dept_name = myGetOne($sql);
		return $dept_name;
	}

?>