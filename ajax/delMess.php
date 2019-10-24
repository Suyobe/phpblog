<?php
	include_once("../conn.php");
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$str = "delete  from message_tb where id =".$id;
		$res = mysqli_query($conn, $str);
		if($res){
			echo 1;
		}

	}else{
		echo 'error';
	}

?>