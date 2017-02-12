<?php include "../connection.php";
/*
* Removes order from seatsSold and marks seats as empty in audSeats.
* Takes input in the form of removeOrder_openOrders.php?id=*&showName=*&seats=*;
*/
	$id = $_GET["id"];
	$showName = $_GET["showName"];
	$seats = explode(',', $_GET["seats"]);
	foreach($seats as $seat){
		$sql = "UPDATE audSeats SET " . $showName . " = 0 WHERE ID = '" . $seat . "';";
		mysqli_query($conn, $sql);
	}
	$sql = "DELETE FROM seatsSold WHERE ID = " . $id . ";";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
?>