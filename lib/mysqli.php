<?php
/**
 * 存放关于数据库的函数
 */

	/**
	 * 连接数据库函数
	 * @return $db 成功则返回数据库对象 
	 */
	function myConnect(){
	  	static $db = null;
	  	if($db === null){
	  		$cfg = include('config.php');
	  		$db = new mysqli($cfg['host'],$cfg['user'],$cfg['password'],$cfg['dbname']);
	  		$db->query("set names ".$cfg['charset']);
	  		if($db->connect_errno!=0){
	  			echo $db->connect_errno."<br>";
	  			die("数据库连接失败！");
	  		}
	  	}
	  	return $db;
	}
	/**
	 * 运行sql函数
	 * @param  string $sql 
	 * @return mixed  返回布尔值型/资源
	 */
	function myQuery($sql){
		$db = myConnect();
		$result =  $db->query($sql);
		if(!$result){
			//???怎么变成$db->error才行了！
			myLog($sql."\n错误提示：".$db->error);
			return false;
		}else{
			myLog($sql);
			return $result;
		}
	}
	/**
	 * 记录日志
	 *
	 * @param   $sql 带记录的sql语句
	 */
	function myLog($sql){
		$filename = PATH.'/log/'.date('Ymd').'.txt';
		//双引号才能识别\n
		$date = '------------------------------'."\n".date('Y/m/d H:i:s')."\n".$sql."\n".'------------------------------'."\n\n";
		file_put_contents($filename,$date,FILE_APPEND);
	}

	/*select * from table where ?*/
	/**
	 * 使用sql查询所有数据
	 * @param  string $sql 
	 * @return mixed array 查询到返回关联二维数组rows,未查询到返回false
	 */
	function myGetAll($sql){
		$result = myQuery($sql);
		if(!$result){
			return false;
		}else{
			$rows = array();
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
		}
		//var_dump($rows);
		return $rows; 
	}
	/**
	 * 查询数据库中的一行以关联数组并返回
	 * @param  string $sql 
	 * @return mixed array 查询到返回一维数组，未查到返回false
	 */
	function myGetRow($sql){
		$result = myQuery($sql);
		return $result?$result->fetch_assoc():false;
	}
	/**
	 * 主要用来查询数量,使用$sql查询并返回一位数组的下标0的值
	 * @param  String $sql 
	 * @return mixed array 正序查询到则返回一行，否则false
	 */
	function myGetOne($sql){
		$result = myQuery($sql);
		if($result){
			$row = $result->fetch_row();
			return  $row[0];
		}else{
			return false;
		}
	}
	/*
	insert into table
	(row1,row2,row3) values('v1','v2','v3');

	update table 
	set row1='v1',row2='v2',row3='v3' 
	where row1 = 's';
	*/
	/**
	 * 执行插入或修改操作，
	 * @param  待操作的表名  $table 
	 * @param  数组  $data   列名作为键，添加(修改)的值作为数组的值
	 * @param  integer $where  默认0
	 * @param  string  $action [description]
	 * @return bool   成功true，错误false
	 */
	function myExec($table, $data, $where = 0,$action='insert'){
		if($action == 'insert'){
			$sql = 'insert into '. $table. '(';
			//implode array_values()
			$sql .= implode(',', array_keys($data)). ") values('";
			$sql .= implode("','",array_values($data)). "')";
			$result = myQuery($sql);
			return $result;
		}else if($action == 'update'){
			$sql = 'update '. $table. ' set ';
			foreach($data as $key=>$value){
				$sql .= $key. "='". $value. "',";
			}
			$sql = rtrim($sql, ','). ' where '.$where;
			return $result = myQuery($sql);
		}
	}
?>