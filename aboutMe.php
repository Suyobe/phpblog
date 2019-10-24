<?php
	session_start(); 
	include_once("conn.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>首页_关于我</title>
<link href="css/base.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<link href="css/m.css" rel="stylesheet">
	
	<link href="css/bootstrap.min.css" rel="stylesheet" />
    <!--<link href="css/font-awesome.min.css" rel="stylesheet" />-->
    <!--<link href="css/weather-icons.min.css" rel="stylesheet" />-->
    <link id="beyond-link" href="css/beyond.min.css" rel="stylesheet" type="text/css" />
<?php  
	include_once("isLogin.php");  //检测用户登录情况
?>
</head>
<body>
<?php include_once("public/_head.html");   ?>
<article>
<?php include_once("public/_left.html");   ?>
  <div class="r_box">
  	<ul class="about">
      <p><img src="<?php echo $ChatHead; ?>"><?php echo $introduce; ?></p>
         
     </ul>
  </div>
</article>
<footer >
  <p>Design by <a href="https://user.qzone.qq.com/1031652797" target="_blank">Suyobe</a> &nbsp;&nbsp;邮箱： abin@qq.com</a> </p>
</footer>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>
</body>
</html>
