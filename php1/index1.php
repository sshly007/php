<?php
//开启session
session_start();
//屏蔽错误
error_reporting(E_ERROR);
//连接数据库并选择数据库
$con=mysqli_connect("localhost","root","","") or die("数据库连接失败");
//字符集更改
mysqli_set_charset($con,'utf8');

//创建数据库数据表
$m="CREATE DATABASE phplianxi";
mysqli_query($con,$m);
$m="use phplianxi";
mysqli_query($con,$m);
$m="CREATE TABLE `userpass` (
	`id` int(255) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	`username` varchar(255) UNIQUE COLLATE utf8_german2_ci NOT NULL COMMENT '用户名',
	`password` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '用户密码',
	`name` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '姓名',
	`phone` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '手机号',
	`dizhi` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '地址'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;
  ";
mysqli_query($con,$m);
$m="CREATE TABLE `yinliao` (
	  `id` int(255) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	  `name` varchar(255) UNIQUE COLLATE utf8_german2_ci NOT NULL COMMENT '饮料'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;";
mysqli_query($con,$m);
$m="  CREATE TABLE `zhucai` (
	  `id` int(255) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	  `name` varchar(255) UNIQUE COLLATE utf8_german2_ci NOT NULL COMMENT '主菜'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;";
mysqli_query($con,$m);
$m="  CREATE TABLE `xiaochi` (
	  `id` int(255) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	  `name` varchar(255) UNIQUE COLLATE utf8_german2_ci NOT NULL COMMENT '小吃'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;";
mysqli_query($con,$m);
$m="INSERT INTO yinliao (name) values ('可乐'),('农夫山泉'),('芬达'),('美年达'),('七喜'),('橙汁');";
mysqli_query($con,$m);
$m="INSERT INTO zhucai (name) values ('水煮肉片'),('水煮鱼'),('番茄炒鸡蛋'),('螺蛳粉'),('麻辣小龙虾'),('青椒炒肉丝');";
mysqli_query($con,$m);
$m="INSERT INTO xiaochi (name) values ('香炸云吞'),('拌面'),('蒸饺'),('鲜肉云吞'),('猪肚粉');";
mysqli_query($con,$m);
$a=password_hash(123456,PASSWORD_DEFAULT);
$m="INSERT INTO userpass (username,password) values ('root','$a');";
mysqli_query($con,$m);


if(array_key_exists('denglu',$_POST)){
	denglu($con);
}
//登录
function denglu($con){
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$yzm=$_POST['security_code'];
	$sql="SELECT * FROM userpass";
	$query=mysqli_query($con,$sql);
	$ar=array();
	$ar1=array();
	while($data=mysqli_fetch_array($query)){
		array_push($ar,$data['username']);
		array_push($ar1,$data['password']);
	}
	if($yzm==$_SESSION['capchar']){
		for($l=0;$l<count($ar);$l++){
			if($ar[$l]==$user){
				if(password_verify("$pass",$ar1[$l])){
					$_SESSION['user']=$user;
					if($_SESSION['user']!=null){
						header("Location:index2.php");
					}
					echo "<script>alert('登录成功!');</script>";
				}else{
					echo "<script>alert('登录失败：密码错误!');</script>";
				}
			}else{
				echo "<script>alert('登录失败：无此账号!');</script>";
			}
		}
	}else{
		echo "<script>alert('登录失败：验证码错误!');</script>";
	}
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>登录</title>
		<style>
			body{
				margin:0;
				padding:0;
				background: linear-gradient(to right, #93fffc,#00d1ff);
			}
			.a{
				background:url(img/2.png) no-repeat;
				width:100%;
				height:100%;
				background-size:100% 100%;
				position:absolute;
			}
			.w {
				width:500px;
				height:420px;
				position: absolute; 
				left: 0;
				top: 0; 
				right: 0; 
				bottom:0;
				margin: auto; 
				text-align: center;
				border-radius: 50px;
			}
			
			span {
				font-size: 20px;
			}
			
			.ii {
				font-size: 20px;
				height: 25px;
				margin-top: 10px;
			}
			
			.i {
				width: 160px;
				height: 35px;
				margin-top: 45px;
				font-size: 23px;
				color: #545454;
				background-color: #65fff5;
				border-width: 1px;
				border-radius: 8px;
			
			}
			
			.i:active {
				background-color: #75d0cc;
			}
			
			a {
				text-decoration: none;
			}
			
			a:active {
				color: #b8a79e;
			}
			.asd{
				font-size:12px;
				margin-left:45%;
			}
		</style>
	</head>
	<body>
		<div class="a">
			<div class="w" id="w">
			<br>
			<h1>登录</h1>
			<form action="index1.php" method="POST">
				<span>用户名:</span>&nbsp;&nbsp;
				<input class="ii" name="user" type="text" placeholder="请输入用户名" />
				<br><br>
				<span>密&nbsp;&nbsp;&nbsp;码:</span>&nbsp;&nbsp;
				<input class="ii" name="pass" type="password" placeholder="请输入密码" />
				<br>
				<br>
				<span>验证码:</span>&nbsp;&nbsp;
				<input type="text" align="left" name="security_code" id="security_code" maxlength="4" placeholder="验证码" style="width: 150px;height: 30px;padding-top: -1px;" class="ii"/>
				<img src="yzm.php" style="vertical-align: middle;" onclick="this.src=this.src+'?k='+Math.random();"/><br/>
				<h3><span class="asd">验证码区分大小写</span></h3>
				<input type="submit" class="i" name="denglu" value="登录">
			</form>
			<br>
			<a href="index.php">未注册用户,点击此处</a>
		</div>
		</div>
		
	</body>
</html>