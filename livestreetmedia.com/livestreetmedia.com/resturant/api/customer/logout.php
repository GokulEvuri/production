<?php
	session_start();	
	if(isset($_POST["username"])){ 
	unset($_SESSION[$_POST["username"]]);
	echo "ok";
	}
	session_destroy();
	
?>