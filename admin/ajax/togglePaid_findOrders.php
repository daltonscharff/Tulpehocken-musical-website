<?php include "../connection.php";
/*
* Toggles order as paid.
* Takes input in the form of togglePaid_findOrders.php?id=*;
*/
	$ID = $_GET["id"];
	$sql = "SELECT paid from seatsSold WHERE ID = " . $ID . ";";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if($row["paid"] == 1){
		$sql = "UPDATE seatsSold SET paid = 0 WHERE ID = " . $ID . ";";
		$sql2 = "UPDATE seatsSold_backup SET paid = 0 WHERE ID = " . $ID . ";";
	}else{
		$sql = "UPDATE seatsSold SET paid = 1 WHERE ID = " . $ID . ";";
		$sql2 = "UPDATE seatsSold_backup SET paid = 1 WHERE ID = " . $ID . ";";
	}
	echo " ";
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql2);
	mysqli_close($conn);
?>