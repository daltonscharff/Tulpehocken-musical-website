<?php include "../connection.php";
/*
* Updates show name, active status, and show title as user types.
* Takes input in the form of updateFields_editShow.php?showName=*&active=*&showID=*&showTitle=*;
*/
	$showName = $_GET["showName"];
	$_GET["active"] == "true" ? $active = 1 : $active = 0;
	$showID = $_GET["showID"];
	$showTitle = $_GET["showTitle"];
	$sql = "UPDATE shows SET showName = '" . $showName . "', active = '" .  $active. "',showTitle = '" . $showTitle . "' WHERE showID = '" . $showID . "';";
	if(!empty($showName) && !empty($showID) && !empty($showTitle)){
		mysqli_query($conn, $sql);
	}else{
		echo "Show name and show title cannot be left blank.";
	}
	echo " ";
	mysqli_close($conn);
?>