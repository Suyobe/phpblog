<?php
	session_start(); 
	include_once("conn.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>首页_日记</title>
<link href="css/base.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" />
    <!--<link href="css/font-awesome.min.css" rel="stylesheet" />-->
    <!--<link href="css/weather-icons.min.css" rel="stylesheet" />-->
    <link id="beyond-link" href="css/beyond.min.css" rel="stylesheet" type="text/css" />
<link href="css/infopic.css" rel="stylesheet">
<link href="css/m.css" rel="stylesheet">
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/piccontent.min.js" type="text/javascript"></script>
<?php  
	include_once("isLogin.php");  //检测用户登录情况
?>
</head>
<body>
<?php include_once("public/_head.html");   ?>
<article>
<?php include_once("public/_left.html");   ?>
  <div class="picsbox">
    <div class="bodymodal"></div>
    <!--播放到第一张图的提示-->
    <div class="firsttop">
      <div class="firsttop_right">
        <div class="close2"> <a class="closebtn1" title="关闭" href="javascript:void(0)"></a> </div>
        <div class="replay">
          <h2 id="div-end-h2"> 已到第一张图片了。 </h2>
          <p> <a class="replaybtn1" href="javascript:;">重新播放</a> </p>
        </div>
      </div>
    </div>
    <!--播放到最后一张图的提示-->
    <div class="endtop">
      <div class="firsttop_right">
        <div class="close2"> <a class="closebtn2" title="关闭" href="javascript:void(0)"></a> </div>
        <div class="replay">
          <h2 id="H1"> 已到最后一张图片了。 </h2>
          <p> <a class="replaybtn2" href="javascript:;">重新播放</a> </p>
        </div>
      </div>
    </div>
    <!--弹出层结束--> 
    <!--图片特效内容开始-->
    <?php 
		$sqlstr3 = "select title ,content, Stime from diary_tb  where Uid = '".$username."' and id = '".$_GET['Tid']."'";
		$result3 = mysqli_query($conn,$sqlstr3);
		while($rows = mysqli_fetch_array($result3)){
			$title = $rows[0]; 
			$content = $rows[1];
			$Stime = $rows[2];
 		}
	?>
    
    <div class="piccontext">
      <h2><?php echo $title; ?></h2>
      <div class="source">
        <div class="source_left"><span><?php echo $Stime; ?></span> </div>
        <div class="source_right"> <a href="javascript:;" class="list">列表查看</a> </div>
        <div class="source_right1"> <a href="javascript:;" class="gaoqing">高清查看</a> </div>
      </div>
      <?php
		$sqlstr4 = "select adress from album_tb where Uid = '".$username."' and Tid = '".$_GET['Tid']."'";
		$result4 = mysqli_query($conn,$sqlstr4);
		$totalNum = mysqli_num_rows($result4);
		$photoes = array();
		$n=0;
		while($result4&&$rows = mysqli_fetch_array($result4)){
			$photoes[$n] = $rows[0];
			$n++; 
 		}
	?>
      <!--大图展示-->
      <div class="picshow">
        <div class="picshowtop"> <a href="#"><img src="" alt="" id="pic1" curindex="0" /></a> <a id="preArrow" href="javascript:void(0)" class="contextDiv" title="上一张"><span id="preArrow_A"></span></a> <a id="nextArrow" href="javascript:void(0)" class="contextDiv" title="下一张"><span id="nextArrow_A"></span></a> </div>
        <div class="picshowtxt">
          <div class="picshowtxt_left"><span>1</span>/<i> <?php echo $totalNum; ?> </i></div>
          <div class="picshowtxt_right"></div>
        </div>
        <div class="picshowlist">
          <div class="picshowlist_mid">
            <div class="picmidleft"> <a href="javascript:void(0)" id="preArrow_B"><span class="sleft"></span></a> </div>
            <div class="picmidmid">
              <ul>
              <?php 
			  for($i=0;$i<$totalNum;$i++){
               	echo' <li> <a href="javascript:void(0);"><img src="'.$photoes[$i].'" alt="" bigimg="'.$photoes[$i].'" text="'.$title.'" /></a></li>';
			  }
			  ?>
              </ul>
            </div>
            <div class="picmidright"> <a href="javascript:void(0)" id="nextArrow_B"><span class="sright"></span></a> </div>
          </div>
        </div>
      </div>
      
      <!--列表展示-->
      <div class="piclistshow">
        <ul>
<?php
		for($i=0;$i<$totalNum;$i++){
         echo ' <li>
            <div class="picimg"><img src="'.$photoes[$i].'" /></div>
            <div class="pictxt">
              <h3>'.$title.'<span>('.(1+$i).'/'.$totalNum.')</span></h3>
            </div>
          </li>';

		}
?>          
        </ul>
      </div>
    </div>
    <div class="pictext">
      <ul>
        <?php echo $content; ?>
      </ul>
    </div>
  </div>
</article>
<footer >
	<p>Design by <a href="https://user.qzone.qq.com/1031652797" target="_blank">Suyobe</a> &nbsp;&nbsp;邮箱： abin@qq.com</a> </p>
</footer>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>
</body>
</html>

  
  
  
  
  
  
  
  
  
  