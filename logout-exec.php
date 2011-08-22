<?php

	require_once('deps/session.inc');
		
	//Unset the variables stored in session
	unset($_SESSION['UID']);
	unset($_SESSION['CLASS']);
	session_destroy();
	
	header("Location: index.php");
	exit();
?>