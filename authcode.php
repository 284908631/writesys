<?php
	//生成验证码
	require './lib/init.php';
	session_start();

	//图片宽高
	$width = 80;
	$height = 44;
	
	$bu = imagecreatetruecolor($width,$height);
	$yellow = imagecolorallocate($bu, 255, 255, 0);
	$green = imagecolorallocate($bu, 0,255, 255);
	$white = imagecolorallocate($bu, 255, 255, 255);

	//填充颜色
	imagefill($bu, 1, 1,$green);

	//创建字符串并设为session
	$str = randString(4);
	$_SESSION['authcode'] = $str;

	//写入字符串,第五种字体
	imagestring($bu, 5, 20, 15, $str, $yellow);
	imageline($bu, rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$white);
	imageline($bu, rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$white);

	//输出到浏览器
	header('Content-type:image/png');
	imagepng($bu);
	echo '<br>';
	imagedestroy($bu);

?>
