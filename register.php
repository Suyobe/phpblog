<?php
	include_once("conn.php");
	$name = $_POST['username'];
	$password = $_POST['password'];
	$introduce = $_POST['introduce'];

	if(!empty($_FILES['photo']['tmp_name'])){
		$fileinfo = $_FILES['photo'];
		if($fileinfo['size']>0){
			$upfile = "img/".$name.".jpg";
			move_uploaded_file($_FILES['photo']['tmp_name'],$upfile);
		}
		$sqlstr = "insert into user_tb(Uid ,password,introduce,ChatHead) values('".$name."','".$password."','".$introduce."','".$upfile."') ";
		$result = mysqli_query($conn,$sqlstr);
		if($result){
			echo "<script language='javascript'type='text/javascript'>"; 
			echo "alert('注册成功');"; 
			echo "window.location.href='login.html'"; 
			echo "</script>"; 	
		}else{
			echo "<script language='javascript'type='text/javascript'>";  
			echo "alert('注册失败');";
			echo "window.location.href='login.html'"; 
			echo "</script>"; 	
		}
	}
	
 	
	
	

?>

