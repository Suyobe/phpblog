<?php 
	header("Content-type:text/html;charset =utf8");
	include_once("conn.php");
/*	$message =iconv('UTF-8','gbk',$_POST['Mess']);
 	$username =iconv('UTF-8','gbk',$_POST['Username']);		
	$time =iconv('UTF-8','gbk',$_POST['Time']);*/
	
	$content = $_POST['Mess'];
	$username = $_POST['Username'];
	$title = $_POST['Title'];
	$times = $_POST['sendTime'];
	$num = $_POST['Num'];
	$sqlstr = "insert into diary_tb(Uid , Tid , title , content , Stime ) values('$username','$num', '$title', '$content','$times')";
 	
	//$sqlstr = " insert into diary_tb(Uid , Tid , title , content , Stime ) values('liuyifei', '897', '测试213213 ','苏永彬，一个很帅的男人 ','2019-06-05')";
	$result = mysqli_query($conn,$sqlstr);
	
	if($result){
		echo 1;
	} 
?>
