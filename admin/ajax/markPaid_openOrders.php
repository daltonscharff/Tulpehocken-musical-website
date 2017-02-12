<?php include "../connection.php";
/*
* Marks order as paid.
* Takes input in the form of markPaid_openOrders.php?id=*;
*/
	$ID = $_GET["id"];
	$sql = "UPDATE seatsSold SET paid = 1 WHERE ID = " . $ID . ";";
	mysqli_query($conn, $sql);
	$sql = "UPDATE seatsSold_backup SET paid = 1 WHERE ID = " . $ID . ";";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
?>