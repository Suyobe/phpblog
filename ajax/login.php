<?php
	session_start();
	// 存储 session 数据
	include_once("../conn.php");
	$name = $_POST['username'];
	$password = $_POST['password'];
	$sqlstr = "select id from user_tb where uid='{$name}' and password='{$password}' ";
	$result = mysqli_query($conn,$sqlstr);
	while($rows = mysqli_fetch_array($result)){
		$id = $rows[0]; 
//		$introduce = $rows[2];
		
	}
	if($result){
		$_SESSION['id'] = $id;
		$_SESSION['username'] = $name;
		echo 'indexEdit.php';
//		echo $_SESSION['id'];
	}else{
		echo 0;
	}
?>