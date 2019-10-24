<!DOCTYPE HTML>
<html>
<head>
<title>完善个人信息</title>
<!-- Custom Theme files -->
<link href="css/selfMessage.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
 .imgbox img{
            border: 1px solid #ddd;
            line-height: 1;
            margin-left: 5px;
            overflow: hidden;
			width:100px;
			height:100px;
        }
</style>
<?php  
	if(!isset($_POST['user'])){
		echo "<script language='javascript'type='text/javascript'>";  
		echo "window.location.href='login.html'"; 
		echo "</script>"; 	
	}
	$name = $_POST['user'];
	$password = $_POST['passwd2'];   
	
?>
</head>
<body>
<!--contact page start here-->
<h1>个人博客注册</h1>
<div class="contact">
	<h2>请完善您的个人信息</h2>
	
	<form id="form" name="form"  action="register.php"  method="post" enctype="multipart/form-data">
		<h3>头像</h3>
        <div class="imgbox" id="imgbox" style=" margin-top:10px;"><img src="img/add.png"   onclick="photo.click()"></div> 
		<input type="file" accept="image/*" id="photo" name="photo" class="photo" style="visibility:hidden ; " >
        <div class="box" id="imgboxid">   </div>
        <h3>介绍一下你自己</h3>
		<textarea id="introduce" name="introduce"  class="i" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'example : I’d like to say “good job!”';}">example : I’d like to say “good job!”</textarea>
		<input type="hidden"  id="username" name="username" value="<?php  echo $name ;?>"/>
        <input type="hidden"  id="password" name="password" value="<?php echo $password ; ?>"/>
        <input type="submit" value="完成注册" />
	</form>
</div>
<footer  style=" color: #a5a4a4;text-align: center;">
	<br/>
  	<p>Design by <a href="https://user.qzone.qq.com/1031652797" target="_blank">Suyobe</a> &nbsp;&nbsp;邮箱： abin@qq.com</a> </p>
</footer>

<script>
$(".photo").change(function(){
    var files = this.files; //获取路径
    var img = new Image();
    var reader = new FileReader();//读取文件
    reader.readAsDataURL(files[0]);
    reader.onload = function(e){
	img.src = this.result;
 	document.getElementById("imgbox").innerHTML = '<img src="' + e.target.result + '" onclick="photo.click()"/>';
       
    }
});
</script>


<!--contact page end here-->	
</body>
</html>