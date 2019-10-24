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
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/weather-icons.min.css" rel="stylesheet" />
    <link id="beyond-link" href="css/beyond.min.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet">
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
  	<li>
    	 <form action="" id="reg" name="reg"  method="post" enctype="multipart/form-data">
         	<input id="title" name="title" style="resize: none; width:100%; height:30px; margin-bottom:10px"  placeholder="请输入主题" autofocus/>  
            <textarea id="mess" name="mess" style="resize: none; width:100%; height:100px"  placeholder="请输入内容"></textarea>  
            <input type="button" id="filebutton" value="上传图片" style="float:right;background:#CCC; color:#FFF;font-size:15px; width:80px ; " onclick="fileAttach.click()">
			<input type="file" id="fileAttach" name="fileAttach[]" multiple style="visibility:hidden ;float:right; "  onchange="xmTanUploadImg(this)">
            <input type="hidden"  id="username" name="username" value="<?php  echo $username ;?>"/>
            <input type="hidden"  id="num" name="num" value="<?php  echo $username ;?>"/>
            <input type="hidden"  id="times" name="times" value="<?php echo date('Y-m-d h:i', time()); ?>"/>       
            <input type="submit"  id="submit" name="submit" value="&nbsp;发表&nbsp;" style="background:#CCC; color:#FFF;font-size:15px; width:60px ;" onClick="send()">
            <div class="img-box" id="imgboxid" style=" margin-top:10px;">   </div> 
         </form> 
 
    </li>
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
  </div>
</article>
<footer>
  <p>Design by <a href="https://user.qzone.qq.com/1031652797" target="_blank">Suyobe</a> &nbsp;&nbsp;邮箱： abin@qq.com</a> </p>
</footer>
 
<script type="text/javascript">
    //选择图片，马上预览
    function xmTanUploadImg(obj) {
 
        var fl=obj.files.length;
        for(var i=0;i<fl;i++){
            var file=obj.files[i];
            var reader = new FileReader();
            //读取文件过程方法
            reader.onloadstart = function (e) {
                console.log("开始读取....");
            }
            reader.onprogress = function (e) {
                console.log("正在读取中....");
            }
            reader.onabort = function (e) {
                console.log("中断读取....");
            }
            reader.onerror = function (e) {
                console.log("读取异常....");
            }
            reader.onload = function (e) {
                console.log("成功读取....");
                var imgstr='<img style="width:100px;height:100px;" src="'+e.target.result+'"/>';
                var oimgbox=document.getElementById("imgboxid");
                var ndiv=document.createElement("div");
                ndiv.innerHTML=imgstr;
                ndiv.className="img-div";
                oimgbox.appendChild(ndiv);
            }
            reader.readAsDataURL(file);
        }
    }
    window.onload = function (){
		var obj=null;
		var As=document.getElementById('nav').getElementsByTagName('a');
		obj = As[0];
		for(i=1;i<As.length;i++){
			if(window.location.href.indexOf(As[i].href)>=0)
				obj=As[i];
		}
		obj.id='selected'
    }
</script>

<script>
 	
	function send(){
				var xml;
				if(window.ActiveXObject){
					xml = new ActiveXObject('Microsoft.XMLHTTP');
				}else if(window.XMLHttpRequest){
					xml = new XMLHttpRequest();
				}
				//var sub = document.querySelector('#submit');
				var mess = document.getElementById("mess").value;
				var photoes = document.getElementById("fileAttach").value;
				var title = document.getElementById("title").value;
				var username = document.getElementById("username").value;
				var time = document.getElementById("times").value;
				var num = "<?php  echo $totalNum ;?>";
				if(mess==""||photoes==""||title==""){					//判断表单提交的值不能为空
					alert('添加的数据不能为空！');
					return false;
				} 
				var sub = document.querySelector('#submit');
 				var post_method ="Username="+username+ "&Mess="+mess+"&Title="+title+"&sendTime="+time+"&Num="+num ;		//构造URL参数

 				xml.open('post','publishMess.php',true);					//调用指定的添加文件
				xml.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");	 //设置请求头信息
				xml.send(post_method);
				xml.onreadystatechange = function(){   //判断URL调用的状态值并处理
					if(xml.readyState==4&&xml.status==200){
						var msg = xml.responseText;
						if(msg ==1){
							/*var form = new FormData();  
							if(sub.files[0]){
								form.append('upfile',sub.files[0]); //有文件才会获取文件
							}
							xml.open('post','publishMess.php',true);
							xml.onload = function(){	}
							xml.send(form); */
							<?php 
							if(!empty($_FILES['fileAttach']['name'])){
								for ($i=0;$i<count($_FILES['fileAttach']['tmp_name']);$i++) {
									$path = "img/".$_FILES['fileAttach']['name'][$i];
									move_uploaded_file($_FILES['fileAttach']['tmp_name'][$i],$path);
									$sqlstr = "insert into album_tb(Uid , Tid , adress  ) values('$username','$totalNum','$path')";
									$result = mysqli_query($conn,$sqlstr);
									
								}
							}
 							?>
				  		location.reload();	
 						}
 					}
 				}			
 	  }

</script>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>
</body>
</html>
