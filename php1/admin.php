<?php
//开启session
session_start();
//屏蔽错误
error_reporting(E_ERROR);
//连接数据库并选择数据库
$con=mysqli_connect("localhost","root","","phplianxi") or die("数据库连接失败");
//字符集更改
mysqli_set_charset($con,'utf8');

$a=0;

if($_SESSION['user']!=null){
	if($_SESSION['user']=='root'){
		
	}else{
		echo "<script>this.location.href='index1.php'</script>";
	}
}else{
	echo "<script>alert('请先登录！');this.location.href='index1.php'</script>";
}

if(array_key_exists('tianjia',$_POST)){
	wangcheng($con);
}elseif(array_key_exists('fanhui',$_POST)){
	fanhui();
}elseif(array_key_exists('tuichu',$_POST)){
	tuichu();
}elseif(array_key_exists('shanchu',$_POST)){
	shanchu($con);
}elseif(array_key_exists('ss',$_POST)){
	$t1=$_POST['radio1'];
	if($t1==-1){
		$a=1;
	}elseif($t1==1){
		$a=2;
	}
}

// 搜索 
function s($con){
	$user=htmlspecialchars(trim($_POST['yhm']));
	$t=$_POST['radio'];
	$m='';
	if($t==0){
		$m="SELECT * FROM form WHERE idname='$user' ;";
	}elseif($t==30){
		$ti=time()-(24*60*60*$t);
		$m="SELECT * FROM form WHERE idname='$user' and shijian>$ti;";
	}elseif($t==7){
		$ti=time()-(24*60*60*$t);
		$m="SELECT * FROM form WHERE idname='$user' and shijian>$ti;";
	}elseif($t==3){
		$ti=time()-(24*60*60*$t);
		$m="SELECT * FROM form WHERE idname='$user' and shijian>$ti;";
	}
	$q=mysqli_query($con,$m);
	$m=0;
	while($data=mysqli_fetch_array($q)){
		$shijian=date("Y-m-d H:i:s",$data['shijian']);
		echo <<<HTMLSTR
				<form action="admin1.php" method="post" >
					<tr>
					<td>$data[idname]</td>
					<td>$data[name]</td>
					<td>$data[phone]</td>
					<td>$shijian</td>
					<td>
						<input type='submit' name='xiangxi' value='详细' />
					</td>
					<td style='display:none;'>
						<input type="text" name="idd" value="$data[id]" />
						<input type="text" name="tz" value="1" />
					</td>
				</tr>
				</form>
		HTMLSTR;
		$m++;
	}
	echo "<b><span style='margin-left:10%;color:#464646;font-size:20px;'>共 $m 条订单</span></b>";
}

function ss($con){
	$phone=htmlspecialchars(trim($_POST['yhm']));
	$t=$_POST['radio'];
	$m='';
	if($t==0){
		$m="SELECT * FROM form WHERE phone='$phone' ;";
	}elseif($t==30){
		$ti=time()-(24*60*60*$t);
		$m="SELECT * FROM form WHERE phone='$phone' and shijian>$ti;";
	}elseif($t==7){
		$ti=time()-(24*60*60*$t);
		$m="SELECT * FROM form WHERE phone='$phone' and shijian>$ti;";
	}elseif($t==3){
		$ti=time()-(24*60*60*$t);
		$m="SELECT * FROM form WHERE phone='$phone' and shijian>$ti;";
	}
	$q=mysqli_query($con,$m);
	$m=0;
	while($data=mysqli_fetch_array($q)){
		$shijian=date("Y-m-d H:i:s",$data['shijian']);
		echo <<<HTMLSTR
				<form action="admin1.php" method="post">
					<tr>
					<td>$data[idname]</td>
					<td>$data[name]</td>
					<td>$data[phone]</td>
					<td>$shijian</td>
					<td>
						<input type='submit' name='xiangxi' value='详细' />
					</td>
					<td style='display:none;'>
						<input type="text" name="idd" value="$data[id]" />
						<input type="text" name="tz" value="1" />
					</td>
				</tr>
				</form>
		HTMLSTR;
		$m++;
	}
	echo "<b><span style='margin-left:10%;color:#464646;font-size:20px;'>共 $m 条订单</span></b>";
}

//初始遍历
function a($con){
	$m="SELECT * FROM form ;";
	$q=mysqli_query($con,$m);
	$m=0;
	while($data=mysqli_fetch_array($q)){
		$shijian=date("Y-m-d H:i:s",$data['shijian']);
		echo <<<HTMLSTR
		<form action="admin1.php" method="post">
			<tr>
			<td>$data[idname]</td>
			<td>$data[name]</td>
			<td>$data[phone]</td>
			<td>$shijian</td>
			<td>
				<input type='submit' name='xiangxi' value='详细' />
			</td>
			<td style='display:none;'>
				<input type="text" name="idd" value="$data[id]" />
				<input type="text" name="tz" value="1" />
			</td>
		</tr>
		</form>
HTMLSTR;
	$m++;
	}
	
	echo "<b><span style='margin-left:10%;color:#464646;font-size:20px;'>共 $m 条订单</span></b>";
}

//退出
function tuichu(){
	unset($_SESSION['user']);
	session_destroy();
	header("Location:index1.php");
}

//返回
function fanhui(){
	header("Location:index2.php");
}

//添加
function wangcheng($con){
	$yl=htmlspecialchars(trim($_POST['yinliao1']));
	$zc=htmlspecialchars(trim($_POST['zhucai1']));
	$xc=htmlspecialchars(trim($_POST['xiaochi1']));
	$qwe='';
	$qwe1='';
	if(!empty($yl)){
		$sql="INSERT INTO yinliao (name) values ('$yl') ;";
		$query=mysqli_query($con,$sql);
		if($query){
			$qwe .= "饮料：$yl ";
		}else{
			$qwe1 .= "饮料：$yl ";
		}
	}
	if(!empty($zc)){
		$sql="INSERT INTO zhucai (name) values ('$zc') ;";
		$query=mysqli_query($con,$sql);
		if($query){
			$qwe .= "主菜：$zc ";
		}else{
			$qwe1 .= "主菜：$zc ";
		}
	}
	if(!empty($xc)){
		$sql="INSERT INTO xiaochi (name) values ('$xc') ;";
		$query=mysqli_query($con,$sql);
		if($query){
			$qwe .= "小吃：$xc ";
		}else{
			$qwe1 .= "小吃：$xc ";
		}
	}
	if(strlen($qwe)!=0){
		echo "<script>alert('$qwe 添加成功！');</script>";
	}
	if(strlen($qwe1)!=0){
		echo "<script>alert('$qwe1 添加失败！');</script>";
	}
}
//删除
function shanchu($con){
	$yl=htmlspecialchars(trim($_POST['yinliao']));
	$zc=htmlspecialchars(trim($_POST['zhucai']));
	$xc=htmlspecialchars(trim($_POST['xiaochi']));
	$qwe='';
	$qwe1='';
	if(!empty($yl)){
		$sql="DELETE FROM yinliao WHERE name='$yl';";
		$query=mysqli_query($con,$sql);
		if(!($query)){
			$qwe .= "饮料：$yl ";
		}else{
			$qwe1 .= "饮料：$yl ";
		}
	}
	if(!empty($zc)){
		$sql="DELETE FROM zhucai WHERE name='$zc';";
		$query=mysqli_query($con,$sql);
		if(!($query)){
			$qwe .= "主菜：$zc ";
		}else{
			$qwe1 .= "主菜：$zc ";
		}
	}
	if(!empty($xc)){
		$sql="DELETE FROM xiaochi WHERE name='$xc';";
		$query=mysqli_query($con,$sql);
		if(!($query)){
			$qwe .= "小吃：$xc ";
		}else{
			$qwe1 .= "小吃：$xc ";
		}
	}
	if(!empty($qwe)){
		echo "<script>alert('$qwe 删除失败！');</script>";
	}
	if(!empty($qwe1)){
		echo "<script>alert('$qwe1 删除成功！');</script>";
	}
}


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport"
			content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>
		<title>管理</title>
		<style>
			br {
				visibility:hidden;
			}
			body {
				margin: 0;
				padding: 0;
			}

			.ra {
				transform: scale(1.3);
			}

			.h {
				margin-left: 20px;
			}

			ul {
				list-style-type: none;
			}
			.u1{
				margin-top: 10px;
			}

			.u1 li {
				float: left;
				margin-left: 10px;
			}

			.u2 li {
				float: left;
				margin-left: 10px;
			}

			.f1 {
				margin-left: 10%;
			}

			.div1 {
				background-color: #2b25cf;
				width: 80%;
				height: 800px;
				margin-left: 10%;
			}

			.ssk {
				width: 180px;
				font-size: 16px;
			}

			.ta {
				width: 80%;
				margin-left: 10%;
				border: #2b25cf solid 1px;
				text-align: center;
			}

			.ta th {
				border: #2b25cf solid 1px;
			}
			.ta td {
				border: #2b25cf solid 1px;
			}

			.caidan {
				display: none;
			}
			.dingdan{
				padding: 0;
				margin: 0;
			}
			.d{
				margin-left: 5%;
			}
		</style>
	</head>
	<body>
		<h2 class="h">管理界面</h2>
		<ul class="u1">
			<li><input type="submit" onclick="dingdan.style.display='block';caidan.style.display='none';"
					value="查看订单" id="ck" /></li>
			<li><input type="submit" onclick="dingdan.style.display='none';caidan.style.display='block';"
					value="修改菜单" id="xg" /></li>
			<li><form action="admin.php" method="post">
					<input type="submit" name="tuichu" value="退出"/>
			</form></li>
			<li><form action="admin.php" method="post">
					<input type="submit" name="fanhui" value="返回"/>
			</form></li>
		</ul>
		<br />

		<div class="dingdan" id="dingdan">
			<br>
			<h4 style="margin-left: 5%;">查看订单</h4>
			<form class="f1" action="admin.php" method="post">
				<div>
					<ul class="u2">
						<li>
							<span>筛选：</span>
						</li>
						<li>
							<input class="ra" type="radio" name="radio" value="0" onclick="" checked />
							<label>全部</label>
						</li>
						<li>&nbsp;&nbsp;&nbsp;
							<input class="ra" type="radio" name="radio" value="30" onclick="" />
							<label>一个月内</label>
						</li>
						<li>&nbsp;&nbsp;&nbsp;
							<input class="ra" type="radio" name="radio" value="7" onclick="" />
							<label>七天内</label>
						</li>
						<li>&nbsp;&nbsp;&nbsp;
							<input class="ra" type="radio" name="radio" value="3" onclick="" />
							<label>三天内</label>
						</li>
					</ul>
					<br>
					<ul class="u1">
						<li style="visibility:hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
						<li>
							<input class="ra" type="radio" name="radio1" value="-1" onclick="" checked />
							<label>用户名</label>
						</li>
						<li>
							<input class="ra" type="radio" name="radio1" value="1" onclick="" />
							<label>手机号码</label>
						</li><br><br>
						<li style="visibility:hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
						<li>
							<input style="width:250px;" class="ssk" type="text" name="yhm" placeholder="请输入要查找的用户名或手机号">
						</li>
						<li>
							<input class="ss" type="submit" name="ss" value="搜索">
						</li>
					</ul>
				</div>
				</form>
			<br><br>
			<table class="ta">
				<tr>
					<th>用户名</th>
					<th>姓名</th>
					<th>手机号</th>
					<th>时间</th>
					<th>详细信息</th>
				</tr>
				<?php
				if($a==0){
					a($con);
				}elseif($a==1){
					s($con);
				}elseif($a==2){
					ss($con);
				}
				?>
				
			</table>

		</div>

		<div class="caidan" id="caidan">
			<br>
			<h4 style="margin-left: 5%;">修改菜单</h4>
			<form action="admin.php" method="post">
				<div class="d">
					<ul class="u1">
						<li><span>增加菜品:</span></li>
						<li><input type="text" name="yinliao1" placeholder="饮料"></li>
						<li><input type="text" name="zhucai1" placeholder="主菜"></li>
						<li><input type="text" name="xiaochi1" placeholder="小吃"></li>
						<li><input type="submit" name="tianjia" value="添加"></li>
					</ul>
				</div>
				<br>
				<div class="d">
					<ul class="u1">
						<li><span>删除菜品:</span></li>
						<li><input type="text" name="yinliao" placeholder="饮料"></li>
						<li><input type="text" name="zhucai" placeholder="主菜"></li>
						<li><input type="text" name="xiaochi" placeholder="小吃"></li>
						<li><input type="submit" name="shanchu" value="删除"></li>
					</ul>
				</div>
			</form>
			<br><br>
			<table class="ta">
				<tr>
					<th>饮料</th>
					<th>主菜</th>
					<th>小吃</th>
				</tr>
				<?php
					$m="SELECT * FROM yinliao ORDER BY id ASC;";
					$q=mysqli_query($con,$m);
					$ar=[];
					while($data=mysqli_fetch_array($q)){
						array_push($ar,$data['name']);
					}
					$m="SELECT * FROM zhucai ORDER BY id ASC;";
					$q=mysqli_query($con,$m);
					$ar1=[];
					while($data=mysqli_fetch_array($q)){
						array_push($ar1,$data['name']);
					}
					$m="SELECT * FROM xiaochi ORDER BY id ASC;";
					$q=mysqli_query($con,$m);
					$ar2=[];
					while($data=mysqli_fetch_array($q)){
						array_push($ar2,$data['name']);
					}
					for($i=0;$i<count($ar) or $i<count($ar1) or $i<count($ar2);$i++){
						echo "<tr><td>$ar[$i]</td><td>$ar1[$i]</td><td>$ar2[$i]</td></tr>";
					}
				?>
			</table>

		</div>
	</body>
</html>
