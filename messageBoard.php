<?php
	session_start(); 
	include_once("conn.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />-->
<title>首页_留言板</title>
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<link href="css/base.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<link href="css/m.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet" />
    <!--<link href="css/font-awesome.min.css" rel="stylesheet" />-->
    <!--<link href="css/weather-icons.min.css" rel="stylesheet" />-->
    <link id="beyond-link" href="css/beyond.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
			.r_box div { background: rgba(255,255,255,0.8);  overflow: hidden; color: #797b7c; }
			.r_box div img { float: right; clear: right; width: 100%; -webkit-transition: all 0.5s; -moz-transition: all 0.5s; transition: all 0.5s; }
			.r_box div:hover img { transform: scale(1.05) }
			.r_box li {    margin-bottom: 10px;	}
</style>  
<?php  
	include_once("isLogin.php");  //检测用户登录情况
?>
</head>
<body>
<?php  
	include_once("public/_head.html");  
?>
<article>
  <?php  
	include_once("public/_left.html");  
?>
  <div class="r_box" > 
 	<!-- 留言板开始-->	
    <div class="about" >
         留言板
         <form action="#" method="post">
            <textarea id="mess" name="mess" style="resize: none; width:100%; height:100px" autofocus></textarea>
            <input type="hidden"  id="username" name="username" value="<?php  echo $username ;?>"/> 
            <input type="hidden"  id="time" name="time" value="<?php echo date('Y-m-d h:i', time()); ?>"/>       
            <input type="submit" value="&nbsp;发表&nbsp;" style="background:#CCC; color:#FFF;font-size:15px; width:60px " onClick="send()"> 
         </form> 
         <br>
<?php
		$sqlstr = "select * from message_tb where Uid = '".$username."'";
		$total = mysqli_query($conn,$sqlstr);
		$totalNum = mysqli_num_rows($total);
		$pagecount = ceil($totalNum/6);
		(!isset($_GET['page']))?($page = 1):$page = $_GET['page'];
		($page<=$pagecount)?$page:($page = $pagecount);
		$f_pageNum = 6*($page-1);
		$sqlstr1 = $sqlstr." limit ".$f_pageNum.",6";
		$result = mysqli_query($conn,$sqlstr1);
 		$num = 0;
?>
         <p>
             <b>留言（<?php echo $totalNum; ?>）</b>  
             <span style="float:right;">
			<?php if($page!=1){
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
		 	</span>
         </p>
         <br><hr>
         <div class="ll"> <!--div class="ll"  start --> 	
<?php
		while($result&&$rows = mysqli_fetch_array($result)){   
			$num++;
?>	
			<ul>
				<li style="float: left;">
					<div style="height:100px; width:100px; float: left;">
						<img src="img/bg.jpg" style=" float:left; width: 70px;height: 70px; float: left;">
					</div>
					<div  style="margin: 0px 5px; width:450px; float: left; ">
						<span style="margin: 0px 0;width:400px;"><?php echo (($page-1)*6+$num); ?>楼</span>
						<div id="mess" style="height:auto !important;height:100px;min-height:60px" >
							<?php echo $rows['content']; ?>
						</div>
					<div style="margin: 0px 0; ">
						<span style=" margin: 10px 0;width:150px; float: left; font-size:9px;"><?php echo $rows['create_time']; ?></span>
					<?php
						if(!isset($_SESSION['visitor'])){
      						echo '<button class="del" style="border: 0; float: right;" mess_id="'.$rows['id'].'"  >删除</button>';
      					}
					?>
					</div>
					</div>
				</li>
			</ul>

<?php
			
 		}
?>

            
            
         </div> <!--div class="ll"  end -->
    </div>
  	<!-- 留言板结束-->
  </div>
</article>
<footer >
	<p>Design by <a href="https://user.qzone.qq.com/1031652797" target="_blank">Suyobe</a> &nbsp;&nbsp;邮箱： abin@qq.com</a> </p>
</footer>
<script>
	$(function(){
		$('.del').click(function(){
			var id = $(this).attr("mess_id");
			var del = confirm("确定删除吗?");
			if(del){
				$.ajax({
					type:"post",
					data:{id:id},
					url:"ajax/delMess.php",
					async:true,
					success:function(data){
						if(data==1){
							location.reload();
						}
					}
				});
			}
		});
	});
	function send(){
				var xml;
				if(window.ActiveXObject){
					xml = new ActiveXObject('Microsoft.XMLHTTP');
				}else if(window.XMLHttpRequest){
					xml = new XMLHttpRequest();
				}
				var mess = document.getElementById("mess").value;
				var username = document.getElementById("username").value;
				var time = document.getElementById("time").value;
				if(mess==""){					//判断表单提交的值不能为空
					alert('添加的数据不能为空！');
					return false;
				} 
 				var post_method = "Mess="+mess+"&Username="+username+"&Time="+time;		//构造URL参数
				xml.open("POST","sendMess.php",true);						//调用指定的添加文件
				xml.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");	 //设置请求头信息
				xml.send(post_method);
				xml.onreadystatechange = function(){   //判断URL调用的状态值并处理
					if(xml.readyState==4&&xml.status==200){
						var msg = xml.responseText;
						if(msg ==1)
							location.reload();
						 
					}
				}			
				
	 
	  }

</script>
<!--<script src="js/skins.min.js"></script>-->
<!--Basic Scripts-->
<!--<script src="js/slimscroll/jquery.slimscroll.min.js"></script>-->
<!--Beyond Scripts-->
<!--<script src="js/beyond.js"></script>-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>
</body>
</html>
