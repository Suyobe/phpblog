<?php
//	if(isset($_GET['visitor'])){
//		$_SESSION['id'] = $_GET['visitor'];
//		$_SESSION['visitor'] = $_GET['visitor'];
//		$sqlstr1 = "select uid from user_tb where id=".$_SESSION['id'];
//		$result1 = mysqli_query($conn,$sqlstr1);
//		while($rows = mysqli_fetch_array($result1)){
//			$_SESSION['username'] = $rows[0]; 
//		}
//	}
	if(!isset($_SESSION['id'])){
		echo "<script language='javascript'type='text/javascript'>";  
		echo "window.location.href='login.html'"; 
		echo "</script>"; 	
	}
	$sqlstr = "select uid, introduce, Chathead from user_tb where id='{$_SESSION['id']}' ";
	$result = mysqli_query($conn,$sqlstr);
	while($rows = mysqli_fetch_array($result)){
		$username = $rows['uid']; 
		$introduce = $rows['introduce'];
		$ChatHead = $rows['Chathead'];
	}
?>