<?php session_start();?>
<!DOCTYPE html>
	<html>
		<head>		
			<title>Confirmation</title>
			<meta charset="utf-8" />
			<meta name="author" content="Dalton Scharff">
			<meta name="keywords" content="Tulpehocken, musical, seat selection">
			<meta name="copyright" content="Tulpehocken Internet Technology Department (c)2016">
			<meta name="language" content="EN">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0">
			<link rel="stylesheet" href="styles/main.css">
		</head>
		<?php
			$servername = #####;
			$username = #####;
			$password = #####;
			$dbname = #####;
			$array = str_getcsv($_POST["selectedSeats"]);
			
			
			//Accesses SQL server
			$conn = mysqli_connect($servername, $username, $password, $dbname);
		?>
		<body>
			<div class="header">
				<hr id="goldBar">
				<a href="index.php">
					<img src="images/logo.png" alt="Tulpehocken Shield Logo">
				</a>
			</div>
			<h1><?php echo $_POST["showTitle"] . " - " . $_POST["showName"];?></h1>
			<p>
			<?php 
				if($_SESSION["success"]){
					$sql = "SELECT ID FROM seatsSold WHERE seats = \"" . $_POST["selectedSeats"] . "\" AND showName = \"" . $_POST["showSelected"] . "\"";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_assoc($result)){
						$orderNumber = $row["ID"];
					}
					mysqli_close($conn);
					$due = 0;
					$due = (($_POST["adult"]*10) + ($_POST["student"]*5));
					?>
					
					<div style="max-width: 600px; margin:auto;">
					<h3 style="margin-bottom:0px;">Thank you!</h3>
					<h4 style="margin-top:0px;">An email has been sent to <?php echo $_POST['email'];?></h4>
					Your order number is <b><?php echo $orderNumber;?></b>.

					<br>
					<table>
						<tr>
							<td class="rightAlignText">
								Show Night:
							</td>
							<td class="leftAlignText">
								<?php echo $_POST["showName"];?>
							</td>
						</tr>
						<tr>
							<td class="rightAlignText">
								Selected Seats:
							</td>
							<td class="leftAlignText">
								<?php echo $_POST["selectedSeats"];?>
							</td>
						</tr>
						<tr>
							<td class="rightAlignText">
								Adult Seats:
							</td>
							<td class="leftAlignText">
								<?php echo $_POST["adult"];?>
							</td>
						</tr>
						<tr>
							<td class="rightAlignText">
								Student Seats:
							</td>
							<td class="leftAlignText">
								<?php echo $_POST["student"];?>
							</td>
						</tr>
						<tr>
							<td class="rightAlignText">
								Golden Age Seats:
							</td>
							<td class="leftAlignText">
								<?php echo $_POST["golden"];?>
							</td>
						</tr>
						<tr>
							<td class="rightAlignText">
								<br>
							</td>
							<td class="leftAlignText">
								<br>
							</td>
						</tr>
						<tr>
							<td class="rightAlignText" style="border-top: solid black 2px;border-bottom: solid black 2px;">
								Amount Due:
							</td>
							<td class="leftAlignText" style="border-top: solid black 2px;border-bottom: solid black 2px;">
								<b>$<?php echo $due;?></b>
							</td>
						</tr>
					</table>
					<p><b>Please send payment to: </b><br>Tulpehocken Area School District<br>Attention: Dory Triest<br>27 Rehrersburg Road<br>Bethel PA 19507<br><br><b>Make checks payable to:</b><br>Tulpehocken Area School District<br><br><u>Please include your order number with your payment.</u><br>Once we receive your payment we will send the tickets to you if time allows or hold them at the ticket window the night of the show.</p>
					</div>
					<?php					
					//Email
					$to = $_POST["email"];
					$subject = "Musical Ticket Order #" . $orderNumber;
					$from = "From: musical@tulpehocken.org";
					$msg = "Thank you for reserving your seats. Your order number is " . $orderNumber . ".\nShow Night: " . $_POST["showName"] . "\nSelected Seats: " . $_POST["selectedSeats"] . "\n\nAdult Seats: " . $_POST["adult"] . "\nStudent Seats: " . $_POST["student"] . "\nGoldent Age Seats: " . $_POST["golden"] . "\n\nTotal Due: $" . $due . "\n\nPlease send payment to: \nTulpehocken Area School District\nAttention: Dory Triest\n27 Rehrersburg Road\nBethel PA 19507\nMake checks payable to: Tulpehocken Area School District\n\nPlease include your order number with your payment. Once we receive your payment we will send the tickets to you if time allows or hold them at the ticket window the night of the show.";
					
					// send email
					if($_SESSION["emailSent"] != 1){
						mail($to,$subject,$msg,$from);
						mail("dtriest@tulpehocken.org",$subject,$msg,$from);
						$_SESSION["emailSent"] = 1;
					}
				}
			?>
			</p>
			
		</body>
	</html>