<?php session_start();
	$_SESSION["emailSent"] = 0;
?>
<!DOCTYPE html>
	<html>
		<head>		
			<title>Reservation Information</title>
			<meta charset="utf-8" />
			<meta name="author" content="Dalton Scharff">
			<meta name="keywords" content="Tulpehocken, musical, seat selection">
			<meta name="copyright" content="Tulpehocken Internet Technology Department (c)2016">
			<meta name="language" content="EN">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0">
			<link rel="stylesheet" href="styles/main.css">
		</head>
			<body style="height: 1000px;">
				<h1><?php echo $_POST["showTitle"] . " - " . $_POST["showName"];?></h1>
				<?php include "loading.txt";?>
				
		<?php
			$servername = #####;
			$username = #####;
			$password = #####;
			$dbname = #####;
			$array = str_getcsv($_POST["selectedSeats"]);
			
			//Accesses SQL server
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			//Check if seats were sold
			$i = 0;
			$a = 0;
			while($array[$i]){
				$sql = "SELECT " . $_POST["showSelected"] . " FROM audSeats WHERE ID= \"" . trim($array[$i]) . "\"";
				$result = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($result)){
					$a += $row[$_POST["showSelected"]];
				}
				$i++;
			}
			
			if($a){
				//If seats are unavailable
				mysqli_close($conn);
				$_SESSION["success"] = false;
				?>
				<form id="form" action="selectSeats.php" method="post">
					<input type="hidden" name="firstName" value="<?php echo $_POST["firstName"]?>">
					<input type="hidden" name="lastName" value="<?php echo $_POST["lastName"]?>">
					<input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
					<input type="hidden" name="phone" value="<?php echo $_POST["phone"];?>">
					<input type="hidden" name="street" value="<?php echo $_POST["street"];?>">
					<input type="hidden" name="city" value="<?php echo $_POST["city"];?>">
					<input type="hidden" name="state" value="<?php echo $_POST["state"];?>">
					<input type="hidden" name="zip" value="<?php echo $_POST["zip"];?>">
					<input type="hidden" name="adult" value="<?php echo $_POST["adult"];?>">
					<input type="hidden" name="student" value="<?php echo $_POST["student"];?>">
					<input type="hidden" name="golden" value="<?php echo $_POST["golden"];?>">
					<input type="hidden" name="showSelected" value="<?php echo $_POST["showSelected"];?>">
					<input type="hidden" name="showTitle" value="<?php echo $_POST["showTitle"];?>">
					<input type="hidden" name="error" value="1">
				</form>
				
				<script>document.getElementById("form").submit();</script>
				<?php				
			}else{
				//If seats are available
				
				$_POST["paid"] == "1" ? $paid = 1 : $paid = 0;
				
				$sql = "INSERT INTO seatsSold VALUES (NULL, \"" . $_POST["firstName"] . "\", \"" . $_POST["lastName"] . "\", \"" . $_POST["email"] . "\", \"" . $_POST["phone"] . "\", \"" . $_POST["street"] . "\", \"" . $_POST["city"] . "\", \"" . $_POST["state"] . "\", \"" . $_POST["zip"] . "\", \"" . $_POST["adult"] . "\", \"" . $_POST["student"] . "\", \"" . $_POST["golden"] . "\", \"" . $_POST["showSelected"] . "\", \"" . $_POST["selectedSeats"] . "\", \"" . $paid . "\", \"" . date("Y-m-d H:i:s") . "\", \"" . $_SERVER['REMOTE_ADDR'] . "\");";
				mysqli_query($conn, $sql);
				//Get most recent assigned ID number_format
				$sql = "SELECT ID FROM seatsSold ORDER BY ID DESC LIMIT 1;";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				
				$sql = "INSERT INTO seatsSold_backup VALUES (" . $row["ID"] . ", \"" . $_POST["firstName"] . "\", \"" . $_POST["lastName"] . "\", \"" . $_POST["email"] . "\", \"" . $_POST["phone"] . "\", \"" . $_POST["street"] . "\", \"" . $_POST["city"] . "\", \"" . $_POST["state"] . "\", \"" . $_POST["zip"] . "\", \"" . $_POST["adult"] . "\", \"" . $_POST["student"] . "\", \"" . $_POST["golden"] . "\", \"" . $_POST["showSelected"] . "\", \"" . $_POST["selectedSeats"] . "\", \"" . $paid . "\", \"" . date("Y-m-d H:i:s") . "\", \"" . $_SERVER['REMOTE_ADDR'] . "\");";
				mysqli_query($conn, $sql);
				$_SESSION["paid"] = $paid;
							
				$i = 0;
				while($array[$i]){
					$sql = "UPDATE audSeats SET " . $_POST["showSelected"] . " = true WHERE ID = \"" . trim($array[$i]) . "\"";
					mysqli_query($conn, $sql);
					//$sql = "UPDATE audSeats_backup SET " . $_POST["showSelected"] . " = true WHERE ID = \"" . trim($array[$i]) . "\"";
					//mysqli_query($conn, $sql);
					$i++;
				}
				$_SESSION["success"] = true;
				?>
				<form id="form" action="confirmation.php" method="post">
					<input type="hidden" name="showSelected" value="<?php echo $_POST["showSelected"];?>">
					<input type="hidden" name="showTitle" value="<?php echo $_POST["showTitle"];?>">
					<input type="hidden" name="showName" value="<?php echo $_POST["showName"];?>">
					<input type="hidden" name="selectedSeats" value="<?php echo $_POST["selectedSeats"];?>">
					<input type="hidden" name="firstName" value="<?php echo $_POST["firstName"]?>">
					<input type="hidden" name="lastName" value="<?php echo $_POST["lastName"]?>">
					<input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
					<input type="hidden" name="adult" value="<?php echo $_POST["adult"];?>">
					<input type="hidden" name="student" value="<?php echo $_POST["student"];?>">
					<input type="hidden" name="golden" value="<?php echo $_POST["golden"];?>">
					<input type="hidden" name="paid" value="<?php echo $_POST["paid"];?>">
				</form>	
				
				<script>document.getElementById("form").submit();</script>
				<?php
			}
		?>
		</body>
	</html>