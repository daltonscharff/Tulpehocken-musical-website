<?php
/*
* Creates a session variable.
* Takes input in the form of addSession.php?variableName=*&value=*
*/
	session_start();
	$variableName = $_GET["variableName"];
	$value = $_GET["value"];
	$_SESSION[$variableName] = $value;
?>