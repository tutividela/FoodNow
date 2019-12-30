<?php
	session_start();
	if(isset($_SESSION['userlog'])){
		unset($_SESSION['userlog']);
		header("Location: principal.php");
	}
	else{
		header("Location: principal.php");
	}
?>