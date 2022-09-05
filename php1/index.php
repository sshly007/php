<?php
//开启session
session_start();
//屏蔽错误
 error_reporting(E_ERROR);
//连接数据库并选择数据库
$con=mysqli_connect("localhost","root","","phplianxi") or die("数据库连接失败");

//字符集更改
mysqli_set_charset($con,'utf8');

if(array_key_exists('zhuce',$_POST)){
	zhuce($con);
}

//注册
function zhuce($con){
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$pattern1='/^[a-zA-Z0-9]{5,12}$/';
	$pattern2='/^[a-zA-Z0-9]{6,15}$/';
	if (!preg_match($pattern1, $user)) {
		echo "<script>alert('注册失败：用户名或者密码格式不正确');</script>";
		header("Location:index.php");
	}elseif (!preg_match($pattern2, $pass)) {
		echo "<script>alert('注册失败：用户名或者密码格式不正确');</script>";
		header("Location:index.php");
	}
	$pass1=password_hash($pass,PASSWORD_DEFAULT);
	$sql="INSERT INTO userpass (username,password,name,phone,dizhi) values ('$user','$pass1','','','')";
	$query=mysqli_query($con,$sql);
	if($query){
		echo "<script>alert('注册成功!');this.location.href='index1.php';</script>";
	}else{
		echo "<script>alert('注册失败:该账号已存在!');</script>";
	}
}

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>注册</title>
		<style type="text/css">
			body{
				margin:0;
				padding:0;
				width:100%;
				height:100%;
				position:absolute;
				background: linear-gradient(to right, #6883f1,#a5f8ff);
			}
			.q{
				width:100%;
				height:100%;
				background:url(img/1.png) no-repeat;
				background-size:100% 100%;
			}
			.s{
				width:500px;
				height:350px;
				position: absolute; 
				left: 0;
				top: 0; 
				right: 0; 
				bottom:0;
				margin: auto; 
				text-align: center;
				background-color:rgba(37, 255, 241, 0.7);
				border-radius: 50px;
			}
			
			span {
				font-size: 20px;
				font-weight:bolder;
				color:#0004ff;
			}
			
			.ii {
				font-size: 20px;
				height: 25px;
				margin-top: 10px;
			}
			
			.i {
				width: 150px;
				height: 35px;
				margin-top: 45px;
				font-size: 23px;
				color: #545454;
				background-color: #8efff2;
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
			h3{
				margin-top: 50px;
			}
		</style>
	</head>
	<body>
	<div class="q">
		<div class="s">
			<h1>注册</h1>
			<form action="index.php" method="POST" >
				<span>用户名:</span>&nbsp;&nbsp;
				<input class="ii" name="user" type="text" pattern="^[a-zA-Z0-9]{5,12}" placeholder="请输入5-12个英文或数字" maxlength="12" minlength="5" />
				<br>
				<br>
				<span>密&nbsp;&nbsp;&nbsp;码:</span>&nbsp;&nbsp;
				<input class="ii" name="pass" type="password" pattern="^[a-zA-Z0-9]{6,15}" placeholder="请输入6-15个英文或数字" maxlength="15" minlength="6" />
				<br>
				<input type="submit" class="i" name="zhuce" value="注册">
			</form>
			<h3><a href="index1.php">登录</a></h3>
		</div>
	</div>
	</body>
</html>
   