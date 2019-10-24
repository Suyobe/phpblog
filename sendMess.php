<?php 
	header("Content-type:text/html;charset =utf8");
	include_once("conn.php");
/*	$message =iconv('UTF-8','gbk',$_POST['Mess']);
 	$username =iconv('UTF-8','gbk',$_POST['Username']);		
	$time =iconv('UTF-8','gbk',$_POST['Time']);*/
	$message = $_POST['Mess'];
	$username = $_POST['Username'];
	$time = $_POST['Time'];
 	$sqlstr = "insert into message_tb(Uid , content, create_time) values('$username','$message ','$time')";
	//$sqlstr = "insert into message_tb(Uid , content  , Stime   ) values('liuyifei','窗前一轮明月 ','2019-06-05')";
	$result = mysqli_query($conn,$sqlstr);	
	if($result){
		echo 1;
	} 
	 
?>
