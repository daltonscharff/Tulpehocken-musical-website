<?php include "../connection.php";
/*
* Removes row from shows table
* Takes input in the form of removeRow_editShow.php?showID=*;
*/
	$showID = $_GET["showID"];
	$sql = "DELETE FROM shows WHERE showID = \"" . $showID . "\";";
	mysqli_query($conn, $sql);
	$sql = "ALTER TABLE audSeats DROP " . $showID . ";";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
?>