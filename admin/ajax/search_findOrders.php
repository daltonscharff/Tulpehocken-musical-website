<?php include "../connection.php";
/*
* Searches for orders by name, order number, and email.
* Takes input in the form of search_findOrders.php?search=*;
*/
	$searchString = $_GET["searchString"];
	$sql = "SELECT * FROM seatsSold";
	if($_GET["order_filter"]){
		if($sql == "SELECT * FROM seatsSold"){
			$sql .= " WHERE ";
		}else{
			$sql .= " OR ";
		}
		$sql .= "ID LIKE '%" . $searchString . "'";
	}
	if($_GET["showName_filter"]){
		if($sql == "SELECT * FROM seatsSold"){
			$sql .= " WHERE ";
		}else{
			$sql .= " OR ";
		}
		$sql .= "showName LIKE '%" . $searchString . "%'";
	}
	if($_GET["name_filter"]){
		if($sql == "SELECT * FROM seatsSold"){
			$sql .= " WHERE ";
		}else{
			$sql .= " OR ";
		}
		$sql .= "CONCAT(firstName, ' ', lastName) LIKE '%" . $searchString . "%' OR CONCAT(lastName, ' ', firstName) LIKE '%" . $searchString . "%'";
	}
	if($_GET["email_filter"]){
		if($sql == "SELECT * FROM seatsSold"){
			$sql .= " WHERE ";
		}else{
			$sql .= " OR ";
		}
		$sql .= "email LIKE '%" . $searchString . "%'";
	}
	if($_GET["phone_filter"]){
		if($sql == "SELECT * FROM seatsSold"){
			$sql .= " WHERE ";
		}else{
			$sql .= " OR ";
		}
		$sql .= "phone LIKE '%" . str_replace("-", "", $searchString) . "%' OR phone LIKE '%" . $searchString . "%'";
	}
	if($_GET["seats_filter"]){
		if($sql == "SELECT * FROM seatsSold"){
			$sql .= " WHERE ";
		}else{
			$sql .= " OR ";
		}
		$sql .= "seats LIKE '%" . $searchString . "%'";
	}
	$sql .= " ORDER BY ID;";
		
	$toReturn = "<table><tr class=bold><td>Order #</td><td>Show Name</td><td>Name</td><td>Email</td><td>Phone #</td><td>Address</td><td>Date Ordered</td><td>Adult</td><td>Student</td><td>Golden Age</td><td>Seats</td><td>Paid</td><td>Remove Order</td></tr>";
	
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			strtoupper($row["state"]) == "PENNSYLVANIA" ? $state = "PA" : $state = $row["state"];
			
			if($row["paid"] == 1){ $row["paid"] = "checked";}
			
			$toReturn .= "<tr style='font-size: .85em'><td><p>" . $row["ID"] . "</p></td><td><p>" . $row["showName"] . "</p></td><td><p>" . $row["firstName"] . " " . $row["lastName"]. "</p></td><td><p>" . $row["email"] . "</p></td><td><p>" . $row["phone"] . "</p></td><td><p>" . $row["street"] . "<br>" . $row["city"] . ", " . $state . " " . $row["zip"] . "</p></td><td><p>" . $row["time"] . "</p></td><td><p>" . $row["adult"] . "</p></td><td><p>" . $row["student"] . "</p></td><td><p>" . $row["golden"] . "</p></td><td><p>" . $row["seats"] . "</p></td><td><input type='checkbox'" . $row["paid"] . " onclick='ajaxNoResponse('togglePaid_findOrders.php?id=" . $row["ID"] . "')></td><td><button onclick='ajaxNoResponse('removeOrder_openOrders.php?id=" . $row["ID"] . "&showName=" . $row["showName"] . "&seats=" . str_replace(' ', '', $row["seats"]) . "', 'findOrders.php')'>Remove</button></td></tr>";
		}
		$toReturn .= "</table>";
	}else{
		$toReturn = "error";
	}
	if(($_GET["order_filter"] + $_GET["showName_filter"] + $_GET["name_filter"] + $_GET["email_filter"] + $_GET["phone_filter"] + $_GET["seats_filter"]) > 0){
		echo $toReturn;
	}
	?>