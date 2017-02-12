<!DOCTYPE html>
	<html>
		<head>
			<title>Ticket Ordering</title>
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
			
			//Accesses SQL server
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			$sql = "SELECT * FROM shows WHERE active=1";
			$result = mysqli_query($conn, $sql);
			
			$iterator = 0;
			if (mysqli_num_rows($result) > 0) {
				//Gather ID and Show Names
				while($row = mysqli_fetch_assoc($result)) {
					$valueArray[$iterator] = $row["showID"];
					$nameArray[$iterator] = $row["showName"];
					$showTitleArray[$iterator] = $row["showTitle"];
					$iterator++;
				}
			}
			
			mysqli_close($conn);		
		?>
		<body>
			<div class="header">
				<hr id="goldBar">
				<a href="index.php">
					<img src="images/logo.png" alt="Tulpehocken Shield Logo">
				</a>
			</div>
			<?php if(count($nameArray)>0){ ?>
			<h1><?php echo $showTitleArray[0];?></h1>
			<p>Select which night you would like to reserve tickets for:</p>
			
			<form action="selectSeats.php" method="post">
				<select name="showSelected">
					<?php
							$iterator = 0;
							while($nameArray[$iterator]){
								?>
									<option value="<?php echo $valueArray[$iterator]?>"><?php echo $nameArray[$iterator];?></option>
								<?php
								$iterator++;
							}
					?>
				</select>
				<input type="hidden" name="showTitle" value="<?php echo $showTitleArray[0];?>">
				<input type="submit" onclick="nextPage()" value="Select Tickets">
			</form>
			<?php 
			}else{
				echo "<br><br><span style='color: red; font-size: 20px;'>No shows available for seat reservation at this time.<br>Check back soon.</span>";
			}			
			?>
			<br>
			<br>
			<p id="footer" style='color: grey' onmouseover="changeColor('black')">If you cannot find the show that you're looking for,<br>feel free to call <b>717-933-4611 x1116</b> for availability.</p>
			<script>
				document.getElementById("footer").style.position = "absolute";
				document.getElementById("footer").style.top = window.innerHeight - 100 + "px";
				console.log(window.innerHeight);
				document.getElementById("footer").style.right = 0;
				document.getElementById("footer").style.left = 0;
				function changeColor(color){
					document.getElementById("footer").style.color = color;
				}
			</script>
		</body>
	</html>