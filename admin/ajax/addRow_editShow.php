<?php include "../connection.php";
/*
* Adds row to shows table
* Takes input in the form of addRow_editShow.php?showName=*&active=*&showID=*&showTitle=*;
*/
	$showName = $_GET["showName"];
	$_GET["active"] == "true" ? $active = 1 : $active = 0;
	$showID = $_GET["showID"];
	$showTitle = $_GET["showTitle"];
	$sql = "SELECT * FROM shows WHERE showID = \"" . $showID . "\";";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 0){
		 $sql = "INSERT INTO shows (showName, active, showID, showTitle) VALUES ('" . $showName . "', '" . $active . "', '" . $showID . "', '" . $showTitle . "');";
		if(!empty($showName) && !empty($showID) && !empty($showTitle)){
			mysqli_query($conn, $sql);
			$sql = "ALTER TABLE audSeats ADD " . $showID . " tinyInt(1) DEFAULT 0;";
			mysqli_query($conn, $sql);
		}else{
			echo "The show name, unique id, and show title fields are required.";
		}
	}else{
		echo "That unique id has already been used.";
	}
	mysqli_close($conn);
?>