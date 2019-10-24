<?php
	session_start(); 
	include_once("conn.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>首页_我的相册</title>
<link href="css/base.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet" />
    <!--<link href="css/font-awesome.min.css" rel="stylesheet" />-->
    <!--<link href="css/weather-icons.min.css" rel="stylesheet" />-->
    <link id="beyond-link" href="css/beyond.min.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet">
<link href="css/m.css" rel="stylesheet">
<style>
	.picbox { width: 100%; overflow: hidden;  }
	.picbox ul { overflow: hidden; width: 24%; float: left; margin-right:10px }
	.picbox ul li a:hover{ color:#C93282}
	.picbox ul li { display: block; background: #FFF; margin: 0 0 20px 0; border: 1px #d9d9d9 solid;}
	.picbox ul li i { margin: 5px; height: auto; overflow: hidden; display: block; }
	.picbox ul li img { width: 100%; }
	.picinfo span { padding: 5px; display: block; color: #666 }


</style>
<?php  
	include_once("isLogin.php");  //检测用户登录情况
?>
<script src="js/scrollReveal.js"></script>
</head>
<body>
<?php include_once("public/_head.html");   ?>
<article>
  <div class="picbox">
<?php
		include_once("conn.php");
    	$sqlstr = "select adress , title from album_tb ,diary_tb where album_tb.Uid = '".$username."' and diary_tb.Uid ='".$username."' and  diary_tb.Tid = album_tb.Tid;";
		$result = mysqli_query($conn,$sqlstr);
		$totalNum = mysqli_num_rows($result);
		$imgSize = (int)($totalNum/4);
		$imgDuo = (int)($totalNum%4);
		$pri = array();
		$titl = array();
		$n=0;
		if($totalNum<=4){
			while($rows = mysqli_fetch_array($result)){
				echo '<ul><li data-scroll-reveal="enter bottom over 1s" ><a href="'.$rows[0].'">';
					echo '<i><img src="'.$rows[0].'"></i><div class="picinfo"><span>'.$rows[1].$totalNum.'</span> </div>';
				echo '</a></li></ul>';
			
 			}
		}else{
			while($rows = mysqli_fetch_array($result)){
				$pri[$n] = $rows[0];
				$titl[$n] = $rows[1];
				$n++;
 			}
			
			echo '<ul>';  //第1列
				for($k=0;$k<$imgSize;$k++){
					echo '<li data-scroll-reveal="enter bottom over 1s" ><a href="'.$pri[$k].'">
					<i><img src="'.$pri[$k].'"></i><div class="picinfo"><span>'.$titl[$k].'</span> </div></a></li>';
					if($imgDuo>=1){ //从0开始 多1张 
						echo '<li data-scroll-reveal="enter bottom over 1s" ><a href="'.$pri[4*$imgSize].'">
							<i><img src="'.$pri[4*$imgSize].'"></i><div class="picinfo"><span>'.$titl[4*$imgSize].'</span> </div></a></li>';
					}
					
				}
			echo '</ul>';
			echo '<ul>';  //第2列
				for($k=$imgSize;$k<2*$imgSize;$k++){
					echo '<li data-scroll-reveal="enter bottom over 1s" ><a href="'.$pri[$k].'">
					<i><img src="'.$pri[$k].'"></i><div class="picinfo"><span>'.$titl[$k].'</span> </div></a></li>';
					if($imgDuo>=2){ //从0开始 多2张
						echo '<li data-scroll-reveal="enter bottom over 1s" ><a href="'.$pri[4*$imgSize+1].'">
							<i><img src="'.$pri[4*$imgSize+1].'"></i><div class="picinfo"><span>'.$titl[4*$imgSize+1].'</span> </div></a></li>';
					}
				}
			echo '</ul>';
			echo '<ul>';  //第3列
				for($k=2*$imgSize;$k<3*$imgSize;$k++){
					echo '<li data-scroll-reveal="enter bottom over 1s" ><a href="'.$pri[$k].'">
					<i><img src="'.$pri[$k].'"></i><div class="picinfo"><span>'.$titl[$k].'</span> </div></a></li>';
					if($imgDuo>=3){ //从0开始 多3张
						echo '<li data-scroll-reveal="enter bottom over 1s" ><a href="'.$pri[4*$imgSize+2].'">
							<i><img src="'.$pri[4*$imgSize+2].'"></i><div class="picinfo"><span>'.$titl[4*$imgSize+2].'</span> </div></a></li>';
					}
				}
			echo '</ul>';
			echo '<ul>';  //第4列
				for($k=3*$imgSize;$k<4*$imgSize;$k++){
					echo '<li data-scroll-reveal="enter bottom over 1s" ><a href="'.$pri[$k].'">
					<i><img src="'.$pri[$k].'"></i><div class="picinfo"><span>'.$titl[$k].'</span> </div></a></li>';
				}
			echo '</ul>';
		}
		
?>

    
    
    
     
  </div>
</article>
<footer >
  	<p>Design by <a href="https://user.qzone.qq.com/1031652797" target="_blank">Suyobe</a> &nbsp;&nbsp;邮箱： abin@qq.com</a> </p>
</footer>
<script>
	if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
		(function(){
			window.scrollReveal = new scrollReveal({reset: true});
		})();
	};
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>
</body>
</html>
