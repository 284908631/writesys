<?php
	require './lib/init.php';
		//检测是否有图片上传
		if(isset($_FILES['xw_wenjian']['name'])&&$_FILES['xw_wenjian']['name']!='' && $_FILES['xw_wenjian']['error']==0){
			//var_dump(createDir());
			//upload/2019/1213/abcde.jpg
			$path = createDir().'/'.randString().getExt($_FILES['xw_wenjian']['name']);
			$absPath = PATH.$path;
			//源文件名tmp_name
			$result = move_uploaded_file($_FILES['xw_wenjian']['tmp_name'], $absPath);
			if($result){
				$data['xw_wenjian'] = $path;
			}
			//var_dump($result);
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	 <form action="" method="post" enctype="multipart/form-data">
                 <div class="form-group">
                    <label>文件:</label>
                    <p>
                    	<a href='./upload/2019/1231/SNurkS.sql'>文件</a>
                        <input type="file" name="xw_wenjian" value="./upload/2019/1231/SNurkS.sql">
                        <input type="submit" >
                    </p>

                </div>
                
</body>
</html>