<?php include "../connection.php"; $_SESSION["tab"] = "totalSales.php";?>
<html>
<?php include "../header.php";?>
<body>
	<?php
	$sql = "SELECT showID FROM shows;";
	$result2 = mysqli_query($conn, $sql);
	while($row2 = mysqli_fetch_assoc($result2)){
		$numOfAdult = 0;
		$numOfStudent = 0;
		$numOfGolden = 0;
		$numOfAdult_paid = 0;
		$numOfStudent_paid = 0;
		$numOfGolden_paid = 0;
		$numOfAdult_unpaid = 0;
		$numOfStudent_unpaid = 0;
		$numOfGolden_unpaid = 0;
		
		?>
		<b><?php echo $row2["showID"];?></b>
		<table>
			<tr class="bold">
				<td style="width: 100px; border-right: solid black 2px;">
					Ticket Type
				</td>
				<td style="width: 100px;">
					Unpaid Seats
				</td>
				<td style="width: 100px;">
					Paid Seats
				</td>
				<td style="width: 100px; border-right: solid black 2px;">
					Total Seats Sold
				</td>
				<td style="width: 100px;">
					Funds to Collect
				</td>
				<td style="width: 100px;">
					Funds Collected
				</td>
				<td style="width: 100px;">
					Total Funds
				</td>
			</tr>
			<?php
			$sql = "SELECT * FROM seatsSold WHERE showName = '" . $row2["showID"] . "';";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)){
				$numOfAdult += $row["adult"];
				$numOfStudent += $row["student"];
				$numOfGolden += $row["golden"];
				echo "<script>console.log(" . $row["paid"] . ");</script>";
				if($row["paid"] == 1){
					$numOfAdult_paid += $row["adult"];
					$numOfStudent_paid += $row["student"];
					$numOfGolden_paid += $row["golden"];
				}else{
					$numOfAdult_unpaid += $row["adult"];
					$numOfStudent_unpaid += $row["student"];
					$numOfGolden_unpaid += $row["golden"];
				}
			}
			?>
			<tr style='font-size: .85em'>
				<td style="border-right: solid black 2px;">
					<b>Adult</b>
				</td>
				<td>
					<?php echo $numOfAdult_unpaid;?>
				</td>
				<td>
					<?php echo $numOfAdult_paid;?>
				</td>
				<td style="border-right: solid black 2px;">
					<?php echo $numOfAdult;?>
				</td>
				<td>
					<?php echo "$" . $numOfAdult_unpaid * 10;?>
				</td>
				<td>
					<?php echo "$" . $numOfAdult_paid * 10;?>
				</td>
				<td>
					<?php echo "$" . $numOfAdult * 10;?>
				</td>
			</tr>
			<tr style='font-size: .85em'>
				<td style="border-right: solid black 2px;">
					<b>Student</b>
				</td>
				<td>
					<?php echo $numOfStudent_unpaid;?>
				</td>
				<td>
					<?php echo $numOfStudent_paid;?>
				</td>
				<td style="border-right: solid black 2px;">
					<?php echo $numOfStudent;?>
				</td>
				<td>
					<?php echo "$" . $numOfStudent_unpaid * 5;?>
				</td>
				<td>
					<?php echo "$" . $numOfStudent_paid * 5;?>
				</td>
				<td>
					<?php echo "$" . $numOfStudent * 5;?>
				</td>
			</tr>
			<tr style='font-size: .85em'>
				<td style="border-right: solid black 2px; border-bottom: solid black 2px;">
					<b>Golden</b>
				</td>
				<td style="border-bottom: solid black 2px;">
					<?php echo $numOfGolden_unpaid;?>
				</td>
				<td style="border-bottom: solid black 2px;">
					<?php echo $numOfGolden_paid;?>
				</td>
				<td style="border-right: solid black 2px; border-bottom: solid black 2px;">
					<?php echo $numOfGolden;?>
				</td>
				<td style="border-bottom: solid black 2px;">
					---
				</td>
				<td style="border-bottom: solid black 2px;">
					---
				</td>
				<td style="border-bottom: solid black 2px;">
					---
				</td>
			</tr>
			<tr style='font-size: .85em'>
				<td style="border-right: solid black 2px;">
					<b><u>Total</u></b>
				</td>
				<td>
					<?php echo $numOfAdult_unpaid + $numOfStudent_unpaid + $numOfGolden_unpaid;?>
				</td>
				<td>
					<?php echo $numOfAdult_paid + $numOfStudent_paid + $numOfGolden_paid;?>
				</td>
				<td style="border-right: solid black 2px;">
					<?php echo $numOfAdult + $numOfStudent + $numOfGolden;?>
				</td>
				<td>
					<?php echo "$" . (($numOfAdult_unpaid*10) + ($numOfStudent_unpaid*5) + ($numOfGolden_unpaid*0));?>
				</td>
				<td>
					<?php echo "$" . (($numOfAdult_paid*10) + ($numOfStudent_paid*5) + ($numOfGolden_paid*0));?>
				</td>
				<td style="border-right: solid black 1px;">
					<?php echo "$" . (($numOfAdult*10) + ($numOfStudent*5) + ($numOfGolden*0));?>
				</td>
			</tr>
		</table>
		<br>
		<br>
		<?php 
	} 
	?>
</body>
</html>