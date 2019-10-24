<?php
	session_start();
	session_destroy();
	if(!isset($_SESSION['visitor'])){
		echo "<script language='javascript'type='text/javascript'>";  
		echo "window.location.href='../login.html'"; 
		echo "</script>"; 	
	}else{
		echo "<script language='javascript'type='text/javascript'>";  
		echo "location.reload();"; 
		echo "</script>"; 	
		
		
	}
?>