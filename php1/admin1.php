<?php
//开启session
session_start();
//屏蔽错误
error_reporting(E_ERROR);
//连接数据库并选择数据库
$con=mysqli_connect("localhost","root","","phplianxi") or die("数据库连接失败");
//字符集更改
mysqli_set_charset($con,'utf8');

if($_SESSION['user']=='root'){

}else{
	echo "<script>alert('请先登录！');this.location.href='index1.php'</script>";
}

$id=$_POST['idd'];
$tz=$_POST['tz'];
$m="SELECT * FROM form WHERE id='$id' ;";
$q=mysqli_query($con,$m);
$data=mysqli_fetch_array($q);

if(array_key_exists('fanhui',$_POST)){
	header("Location:admin.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport"
			content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>		<title>管理</title>
		<style>
			body {
				margin: 0;
				padding: 0;
			}
			p{
				font-size:20px;
			}
		</style>
	</head>
	<body>
	<form action="admin1.php" method="post" >
		<div class="container">
			<div class="page-header">
				<h1>订单详细</h1>
			</div>
			<div style="margin-left:10%;font-size:18px;">
				<p><b>用户名:</b>&nbsp;&nbsp;<?php echo $data['idname']? : '无'; ?></p>
				<p><b>姓名:</b>&nbsp;&nbsp;<?php echo $data['name']? : '无'; ?></p>
				<p><b>手机号码:</b>&nbsp;&nbsp;<?php echo $data['phone']? : '无'; ?></p>
				<p><b>分量:</b>&nbsp;&nbsp;<?php echo $data['fenliang']? : '无'; ?></p>
				<p><b>饮料:</b>&nbsp;&nbsp;<?php echo $data['yinliao']? : '无'; ?></p>
				<p><b>主菜:</b>&nbsp;&nbsp;<?php echo $data['zhucai']? : '无'; ?></p>
				<p><b>小吃:</b>&nbsp;&nbsp;<?php echo $data['xiaochi']? : '无'; ?></p>
				<p><b>金额:&nbsp;&nbsp;<?php echo $data['jine']? : '无'; ?></b></p>
				<p><b>送餐:</b>&nbsp;&nbsp;<?php echo $data['songcan']? : '无'; ?></p>
				<p><b>备注:</b>&nbsp;&nbsp;<?php echo $data['beizhu']? : '无'; ?></p>
				<p><b>地址:</b>&nbsp;&nbsp;<?php echo $data['dizhi']? : '无'; ?></p>
				<p><b>下单时间:</b>&nbsp;&nbsp;<?php echo date("Y-m-d H:i:s",$data['shijian'])? : '无'; ?></p>
			</div>
			<input type="submit" value="返回" name="fanhui" class="btn btn-primary" style="margin-left:80%;font-size:25px;"/>
		</div>
	
	</form>
		
	</body>
</html>
