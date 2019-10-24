<?php
	session_start(); 
	include_once("conn.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>首页</title>
<link href="css/base.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet" />
    <!--<link href="css/font-awesome.min.css" rel="stylesheet" />-->
    <!--<link href="css/weather-icons.min.css" rel="stylesheet" />-->
    <link id="beyond-link" href="css/beyond.min.css" rel="stylesheet" type="text/css" />
<link href="css/m.css" rel="stylesheet">
<?php 
	include_once("isLogin.php");  //检测用户登录情况
?>
<style type="text/css">
        .img-div{
            border: 1px solid #ddd;
            float: left;
            line-height: 1;
            margin-left: 5px;
            overflow: hidden;
        }
 
</style>
</head>
<body>
<?php include_once("public/_head.html");   ?>
<article>
	<?php include_once("public/_left.html");   ?>
  <div class="r_box">
     <?php
 
		while($result&&$rows = mysqli_fetch_array($result)){
			echo '<li>';
				echo '<i><a href="'.$rows[0].'"><img src="'.$rows[0].'"></a></i>';
				echo '<h3><a href="showInfo.php?Tid='.$rows[4].'&Uid='.$username.'" onClick="">'.$rows[1].'</a></h3>';
				echo '<p>'.$rows[2].'</p>';
				echo '<p style=" margin: 10px 0;width:400px; font-size:9px;">'.$rows[3].'</p>';
			echo '</li>';
 		}
	?>
    <div class="pagelist">
<?php
	echo "第".$page."页/共".$pagecount."页&nbsp;&nbsp;";
	if($page!=1){
		echo "<a href='?page=1'>首页</a>&nbsp;";
		echo "<a href='?page=".($page-1)."'>上一页</a>&nbsp;&nbsp;";
	}else{
		echo "首页&nbsp;上一页&nbsp;&nbsp;";
	}
	if($page!=$pagecount){
		echo "<a href='?page=".($page+1)."'>下一页</a>&nbsp;";
		echo "<a href='?page=".$pagecount."'>尾页</a>&nbsp;&nbsp;";
	}else{
		echo "下一页&nbsp;尾页&nbsp;&nbsp;";
	}
?>
    </div>
</article>
<footer >
  <p>Design by <a href="https://user.qzone.qq.com/1031652797" target="_blank">Suyobe</a> &nbsp;&nbsp;邮箱： abin@qq.com</a> </p>
</footer>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>
</body>
</html>
