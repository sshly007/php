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
$mysql1="use phplianxi";
$sqlquery=mysqli_query($con,$mysql1);
$mysql2="CREATE TABLE `form` (
	`id` int(255) UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
	`idname` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '用户名',
	`name` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '姓名',
	`phone` varchar(255) NOT NULL COMMENT '手机号码',
	`fenliang` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '分量',
	`yinliao` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '饮料',
	`zhucai` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '主菜',
	`xiaochi` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '小吃',
	`jine` int(255) COLLATE utf8_german2_ci NOT NULL COMMENT '金额',
	`songcan` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '送餐',
	`beizhu` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '备注',
	`dizhi` varchar(255) COLLATE utf8_german2_ci NOT NULL COMMENT '地址',
	`shijian` BIGINT(255) COLLATE utf8_german2_ci NOT NULL COMMENT '订单时间'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;";
$sqlquery=mysqli_query($con,$mysql2);

$user='';
if($_SESSION['user']!=null){
	$user=$_SESSION['user'];
}else{
	echo "<script>alert('请先登录！');this.location.href='index1.php'</script>";
}

if(array_key_exists('xiugai',$_POST)){
	xiugai($con,$user);
}elseif(array_key_exists('tuichu',$_POST)){
	tuichu();
}elseif(array_key_exists('submit',$_POST)){
	tijiao($con);
}

//提交订单
function tijiao($con){
	$errors = [];
	
	$user=$_SESSION['user'];
	
	$mz=htmlspecialchars(trim($_POST['name']));
	if (empty($mz)) {
		echo "<script>alert('名字不能为空！');</script>";
		return null;
	}
	
	$sjh=$_POST['phone'];
	$pattern = '/^1(3\d|4[4-9]|5[0-35-9]|6[67]|7[013-8]|8\d|9\d)\d{8}$/';
	if (!preg_match($pattern, $sjh)) {
	    echo "<script>alert('手机号码不正确！');</script>";
		return null;
	}
	
	$fl=$_POST['fenliang'];
	$z=0;
	if($fl=='小'){
		$z=10;
	}elseif($fl=='中'){
		$z=20;
	}elseif($fl=='大'){
		$z=30;
	}
	
	$yl=$_POST['yinliao'];
	
	$zc=$_POST['zhucai'];
	if(empty($zc)){
		echo "<script>alert('请选择主菜！');</script>";
		return null;
	}
	$zc1='';
	for($i=0;$i<count($zc);$i++){
		if(($i+1)==count($zc)){
			$zc1 .= $zc[$i];
		}else{
			$zc1 .= $zc[$i].',';
		}
	}
	
	$xc=$_POST['xiaochi'];
	if(empty($xc)){
		echo "<script>alert('请选择小吃！');</script>";
		return null;
	}
	$xc1='';
	for($i=0;$i<count($xc);$i++){
		if(($i+1)==count($xc)){
			$xc1 .= $xc[$i];
		}else{
			$xc1 .= $xc[$i].',';
		}
	}
	//饮料5元，主菜小吃按分量计算金额
	$je=5+(count($xc)*$z)+(count($zc)*$z);
	
	$sc=$_POST['songcan'];
	
	$bz=htmlspecialchars(trim($_POST['beizhu']));
	if(empty($bz)){
		$bz='无';
	}
	
	if($sc=='送餐'){
		$dz=htmlspecialchars(trim($_POST['dizhi']));
	}else{
		$dz='到店就餐';
		$sc='不送餐';
	}
	$sj=time();
	
	$sql="INSERT INTO form (idname,name,phone,fenliang,yinliao,zhucai,xiaochi,jine,songcan,beizhu,dizhi,shijian)
			values ('$user','$mz','$sjh','$fl','$yl','$zc1','$xc1','$je','$sc','$bz','$dz','$sj');";
	$query=mysqli_query($con,$sql);
	if($query){
		echo "<script>alert('提交成功!');this.location.href='index2.php'</script>";
	}
}

//退出
function tuichu(){
	unset($_SESSION['user']);
	session_destroy();
	header("Location:index1.php");
}

//修改
function xiugai($con,$user){
	$xm=htmlspecialchars(trim($_POST['xm']));
	$sjh=$_POST['sjh'];
	$pattern = '/^1(3\d|4[4-9]|5[0-35-9]|6[67]|7[013-8]|8\d|9\d)\d{8}$/';
	$dz=$_POST['dz'];
	if (empty($xm)) {
		echo "<script>alert('名字不能为空！');this.location.href='index2.php';</script>";
		return null;
	}
	if (!preg_match($pattern, $sjh)) {
	    echo "<script>alert('手机号码不正确！');this.location.href='index2.php';</script>";
		return null;
	}
	$sql1="UPDATE userpass SET name='$xm',phone='$sjh',dizhi='$dz' WHERE username='$user';";
	$query1=mysqli_query($con,$sql1);
	if($query1){
		echo "<script>alert('修改成功!');this.location.href='index2.php'</script>";
	}
	
	
}

?>
<html>
<head>
	<meta charset="utf-8">
	<title>用户</title>
	<link rel="stylesheet" href="css1.css">
	<link href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>
</head>
<style>
	.e .u1 a{
		text-decoration: none;
	}
	.e .u1{
		height: 35px;
	}
	body{
		margin:0;
		padding:0;
		background: url(img/3.jpg) no-repeat;
		width:100%;
		height:100%;
		background-size:100% 100%;
		position:absolute;
		font-weight:bold;
		color:#550000;
	}
	.box1{
		background-color: rgba(255, 255, 255, 0.7);
		height: auto;
		width: 80%;
	}
	.box2{
		background-color: rgba(255, 255, 255, 0.7);
		height: auto;
		width: 80%;
	}
	.box3{
		background-color: rgba(255, 255, 255, 0.7);
		height: auto;
		width: 80%;
	}
</style>
<body>
	<div class="e">
		<ul class="u1">
			<li><a class="l3" onclick="box1.style.display='block';box2.style.display='none';box3.style.display='none';" href="#">用户信息</a></li>
			<li><a class="l3" onclick="box2.style.display='block';box1.style.display='none';box3.style.display='none';" href="#">添加订单</a></li>
			<li><a class="l3" onclick="box3.style.display='block';box1.style.display='none';box2.style.display='none';" href="#">历史订单</a></li>
			<?php
				if($user=='root'){
					echo "<li><a class='l3' href='admin.php'>管理界面</a></li>";
				}
			?>
		</ul>
	</div>

<?php
	$sql = "SELECT * FROM userpass WHERE username='$user';";
	$query1 = mysqli_query($con, $sql);
	$data = mysqli_fetch_array($query1);
	$name = $data['name'];
	$phone = $data['phone'];
	$dizhi = $data['dizhi'];
?>
	<div class="box1" id="box1">
		<div class="box-head">用户信息</div>
		<div class="box-body">
			<form action="index2.php" method="post">
				<table id="t">
					<tr>
						<th>用 户 名：</th>
						<td><?php echo $user; ?></td>
					</tr>
					<tr>
						<th>姓&nbsp;&nbsp;&nbsp;名：</th>
						<td><?php echo $name;?></td>
					</tr>
					<tr>
						<th>手机号码：</th>
						<td><?php echo $phone;?></td>
					</tr>
					<tr>
						<th>地&nbsp;&nbsp;&nbsp;址 ：</th>
						<td><?php echo $dizhi;?></td>
					</tr>
					<tr>
						<th><input type="button" onclick="t1.style.display='block';tuichu.style.display='none';t.style.display='none';" value="修改信息"></th>
					</tr>					
				</table>
				<table id="t1" style="display: none;">
				<tr>
					<th>用 户 名：</th>
					<td><?php echo $user; ?></td>
				</tr>
				<tr>
					<th>姓&nbsp;&nbsp;&nbsp;名：</th>
					<td>
						<input type="text" name="xm" value="<?php echo $name; ?>" />
					</td>
				</tr>
				<tr>
					<th>手机号码：</th>
					<td>
						<input type="text" name="sjh" value="<?php echo $phone; ?>" />
					</td>
				</tr>
				<tr>
					<th>地&nbsp;&nbsp;&nbsp;址 ：</th>
					<td>
						<input type="text" name="dz" value="<?php echo $dizhi; ?>" />
					</td>	
				</tr>
					<tr>
						<th><input type="submit" name="xiugai" value="修改完成" style="width: 64px;height: 21px;font-size: 12px;padding: 1px 1px 1px 1px;"></th>
					</tr>
					<tr>
						<th><input type="button" onclick="t.style.display='block';t1.style.display='none';tuichu.style.display='block';" value="退出修改" /></th>
					</tr>
						<input type="submit" id="tichu" name="tuichu" value="退出登录" style="margin-top: 230px;margin-right: 30px;" />
				</table>
			</form>
		</div>
	</div>


	<div class="box2" id="box2">
		<div class="box-head">订餐信息</div>
		<div class="box-body">
			<form action="index2.php" method="post">
				<table>
					<tr>
						<th>姓　　名：</th>
						<td><input type="text" required="required" placeholder="请输入姓名" name="name" size="25" value="<?php echo $name;?>"></td>
					</tr>
					<tr>
						<th>手机号码：</th>
						<td><input type="text" required="required" placeholder="请输入手机号码" name="phone" size="25" value="<?php echo $phone;?>"></td>
					</tr>
					<tr>
						<th>份　　量：</th>
						<td>
							<input type="radio" name="fenliang" value="小" checked>小(10)
							<input type="radio" name="fenliang" value="中">中(20)
							<input type="radio" name="fenliang" value="大">大(30)
						</td>
					</tr>
					<tr>
						<th>一种饮料：</th>
						<td><select name="yinliao">
								<?php 
									$s="SELECT * FROM yinliao;";
									$q=mysqli_query($con,$s);
									while($d=mysqli_fetch_array($q)){
										if(empty($d['name'])){
											break;
										}
										echo "<option value='".$d['name']."'>".$d['name']."</option>";
									}
								?>
							</select></td>
					</tr>
					<tr>
						<th>主菜：</th>
						<td><select name="zhucai[]" multiple size="4">
								<?php
									$s="SELECT * FROM zhucai;";
									$q=mysqli_query($con,$s);
									while($d=mysqli_fetch_array($q)){
										if(empty($d['name'])){
											break;
										}
										echo "<option value='".$d['name']."'>".$d['name']."</option>";
									}
								?>
							</select></td>
					</tr>
					<tr>
						<th>小吃：</th>
						<td><select name="xiaochi[]" multiple size="4">
								<?php
									$s="SELECT * FROM xiaochi;";
									$q=mysqli_query($con,$s);
									while($d=mysqli_fetch_array($q)){
										if(empty($d['name'])){
											break;
										}
										echo "<option value='".$d['name']."'>".$d['name']."</option>";
									}
								?>
							</select></td>
					</tr>
					<tr>
						<th>送　　餐：</th>
						<td>
							<input type="checkbox" name="songcan" id="sc" value="送餐" checked onclick="chock(this);">是
						</td>
					</tr>
					<script>
						 function chock(ck){  
							if(ck.checked==true){
								document.getElementById("dz").style.display = 'block';
								document.getElementById("dz1").style.display = 'none';
								ck.value='送餐';
							}else{
							    document.getElementById("dz").style.display = 'none';
								document.getElementById("dz1").style.display = 'block';
								document.getElementById("dz").style.width = '82px';
								ck.value='不送餐';
							}
						}
					</script>
					<tr>
						<th>备注：<br />(50字内)</th>
						<td><textarea name="beizhu" cols="50" rows="3" maxlength="50"></textarea></td>
					</tr>
					<tr id="dz">
						<th>地&nbsp;址：</th>
						<td><textarea name="dizhi" cols="30" rows="2"><?php echo $dizhi;?></textarea></td>
					</tr>
					<tr id="dz1" style="display:none;">
						<td><h4 style="color:red;"><b>到店就餐</b></h4></td>
					</tr>
				</table>
				<input type="submit" name="submit" value="提交">
			</form>
		</div>
	</div>

	<div class="box3" id="box3">
		<div class="box-head">订单历史</div>
		<div class="box-body">
			<table style="margin-left:5%; width:90%;">
				<tr>
					<th>姓名</th>
					<th>手机号码</th>
					<th>地址</th>
					<th>分量</th>
					<th>饮料</th>
					<th>主菜</th>
					<th>小吃</th>
					<th>金额</th>
					<th>送餐</th>
					<th>备注</th>
					<th>订单时间</th>
				</tr>
				<?php
				//遍历订单数据
					$sql = "SELECT * FROM form WHERE idname='$user';";
					$query1 = mysqli_query($con, $sql);
					$ar1=0;
					while(($data1 = mysqli_fetch_array($query1))){
						?>
						<tr><td><?php echo $data1['name'];?></td>
						<td><?php echo $data1['phone'];?></td>
						<td><?php echo $data1['dizhi'];?></td>
						<td><?php echo $data1['fenliang'];?></td>
						<td><?php echo $data1['yinliao'];?></td>
						<td><?php echo $data1['zhucai'];?></td>
						<td><?php echo $data1['xiaochi'];?></td>
						<td><?php echo $data1['jine'];?></td>
						<td><?php echo $data1['songcan'];?></td>
						<td><?php echo $data1['beizhu'];?></td>
						<td><?php echo date("Y-m-d H:i:s",$data1['shijian']);?></td></tr>
						<?php
						$ar1+=1;
					}
				?>
			</table>
			<br>
			<p>共计<?php echo $ar1; ?>次订单</p>
		</div>
	</div>


</body>

</html>