<?php
	session_start(); 
include_once("conn.php");
if(isset($_GET['v'])){
		$_SESSION['id'] = $_GET['v'];
		$_SESSION['visitor'] = $_GET['v'];
		$sqlstr1 = "select uid from user_tb where id=".$_SESSION['id'];
		$result1 = mysqli_query($conn,$sqlstr1);
		while($rows = mysqli_fetch_array($result1)){
			$_SESSION['username'] = $rows[0]; 
		}
		if($result1){
			echo "<script language='javascript'type='text/javascript'>"; 
			echo "window.location.href='index.php'"; 
			echo "</script>"; 
		}else{
			echo "<script language='javascript'type='text/javascript'>"; 
			echo "location.reload();"; 
			echo "</script>"; 
		}
}
?>