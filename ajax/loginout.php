<?php
	session_start();
	session_destroy();
	if(isset($_SESSION['id'])){
		echo 1;
	}
?>