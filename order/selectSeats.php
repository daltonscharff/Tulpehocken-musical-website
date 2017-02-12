<!DOCTYPE html>
	<html>
		<head>		
			<title>Seat Selection</title>
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
			
			$sql = "SELECT showName FROM shows WHERE showID=\"" . $_POST["showSelected"] . "\"";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)){
				$showName = $row["showName"];
			}
			
			$sql = "SELECT ID FROM audSeats WHERE " . $_POST["showSelected"] . "= 1";
			$result = mysqli_query($conn, $sql);
			
			while($row = mysqli_fetch_assoc($result)){
				$export = $row["ID"] . ", " . $row["showName"] . ", " . $export;
			}
			mysqli_close($conn);		
		?>
		<body onload="populateSeats(), activateButtons()">		
			<div class="header">
				<hr id="goldBar">
				<a href="index.php">
					<img src="images/logo.png" alt="Tulpehocken Shield Logo">
				</a>
			</div>
			<h1><?php echo $_POST["showTitle"] . " - " . $showName;?></h1>
			<p>Click to select seats for the <?php echo $showName?> show by clicking on the seat icons below.</p>
			<table class="legend">
				<tr>
					<td>
						<img class="seats" src="images/chair_empty.png">
						Empty Seat |
					</td>
					<td>
						<img class="seats" src="images/chair_selected.png">
						Selected Seat |
					</td>
					<td>
						<img class="seats" src="images/chair_purchased.png">
						Sold Seat
					</td>
				</tr>
			</table>
		
			<table>
				<tr>
					<td>
						<div class="invisible sectionWidth"></div>
					</td>
					<td>
						<div class="stage">STAGE</div>
					</td>
					<td>
						<div class="invisible sectionWidth"></div>
					</td>
				</tr>
			</table>
			
			<div id="seatLayout"></div>	
			<p id="selectedLabel">Selected Seats: </p>
			<form action="reserveInfo.php" method="post">
				<input type="hidden" name="selectedSeats" id="formInfo">
				<input type="hidden" name="showSelected" value="<?php echo $_POST["showSelected"];?>">
				<input type="hidden" name="showTitle" value="<?php echo $_POST["showTitle"];?>">
				<input type="hidden" name="showName" value="<?php echo $showName;?>">
				
				<input type="hidden" name="firstName" value="<?php echo $_POST["firstName"];?>">
				<input type="hidden" name="lastName" value="<?php echo $_POST["lastName"];?>">
				<input type="hidden" name="email" value="<?php echo $_POST["email"];?>">
				<input type="hidden" name="phone" value="<?php echo $_POST["phone"];?>">
				<input type="hidden" name="street" value="<?php echo $_POST["street"];?>">
				<input type="hidden" name="city" value="<?php echo $_POST["city"];?>">
				<input type="hidden" name="state" value="<?php echo $_POST["state"];?>">
				<input type="hidden" name="zip" value="<?php echo $_POST["zip"];?>">
				<input type="hidden" name="adult" value="<?php echo $_POST["adult"];?>">
				<input type="hidden" name="student" value="<?php echo $_POST["student"];?>">
				<input type="hidden" name="golden" value="<?php echo $_POST["golden"];?>">
				
				<button id="clearButton" type="button" onclick="clearSelected()">Clear Selected</button>
				<button id="submitButton" type="submit">Submit</button>
			</form>
			<div id="invisibleSoldSeats" class="invisible"><?php echo $export;?></div>
			<div class="invisible" id="error"><?php echo $_POST["error"];?></div>
			
			<script>
				if(document.getElementById("error").innerHTML == 1){
					alert("We apologize, but the seats that you had previously selected have already been purchased. Please select new seats.");
				}
			
				var allSold = document.getElementById("invisibleSoldSeats").innerHTML;
				var ROWS = 18;
				var COLS = 42;
				var selectedCount = 0;
				var seat = new Array(COLS);
				for (var i = 0; i < COLS; i++) {
					seat[i] = new Array(ROWS);
				}
				
				function populateSeats(){
					var allSeatCount = 0;
					var labeledNumber = -1;
					var backgroundColor = "#ffffff";
					var toBeWritten;
					toBeWritten = "<table>\n";
					var row = 0;
					while(row < ROWS){
						toBeWritten += "<tr>\n";
						var col = 0;
						while(col < COLS){
							var rowLetter;
							switch(row){
								case 0:
									rowLetter = "B";
									break;
								case 1:
									rowLetter = "C";
									break;
								case 2:
									rowLetter = "D";
									break;
								case 3:
									rowLetter = "E";
									break;
								case 4:
									rowLetter = "F";
									break;
								case 5:
									rowLetter = "G";
									break;
								case 6:
									rowLetter = "H";
									break;
								case 7:
									rowLetter = "J";
									break;
								case 8:
									rowLetter = "K";
									break;
								case 9:
									rowLetter = "L";
									break;
								case 10:
									rowLetter = "M";
									break;
								case 11:
									rowLetter = "N";
									break;
								case 12:
									rowLetter = "O";
									break;
								case 13:
									rowLetter = "P";
									break;
								case 14:
									rowLetter = "Q";
									break;
								case 15:
									rowLetter = "R";
									break;
								case 16:
									rowLetter = "S";
									break;
								case 17:
									rowLetter = "T";
									break;
							}
							
							//Seat Numbering
							if(allSeatCount % 42 < 14){
								labeledNumber = 27 - ((allSeatCount % 42) * 2);
							}else if(allSeatCount % 42 > 27){
								labeledNumber = ((allSeatCount % 14) + 1) * 2;
							}else{
								labeledNumber = 128 - (allSeatCount % 42) 
							}
							
							//Row Labels
							if(allSeatCount % 14 == 0 && allSeatCount % 42 != 0){
								toBeWritten += "<td class=\"rowLetters\"> " + rowLetter + " </td>"
							}
							
							//Hide False Seats
							if(allSeatCount < 10 || (allSeatCount > 31 && allSeatCount < 49) || (allSeatCount > 76 && allSeatCount < 89) || (allSeatCount > 120 && allSeatCount < 131) || (allSeatCount > 162 && allSeatCount < 173) || (allSeatCount > 204 && allSeatCount < 214) || (allSeatCount > 247 && allSeatCount < 256) || (allSeatCount > 289 && allSeatCount < 298) || (allSeatCount > 331 && allSeatCount < 339) || (allSeatCount > 374 && allSeatCount < 381) || (allSeatCount > 416 && allSeatCount < 423) || (allSeatCount > 458 && allSeatCount < 464) || (allSeatCount > 501 && allSeatCount < 506) || (allSeatCount > 543 && allSeatCount < 548) || (allSeatCount > 585 && allSeatCount < 589) || allSeatCount == 629 || allSeatCount == 630 || allSeatCount == 671 || allSeatCount == 672 || allSeatCount == 713 || allSeatCount == 196 || allSeatCount == 197 || allSeatCount == 238 || allSeatCount == 239){
								seat[col][row] = {row:rowLetter, number:labeledNumber, selected:"0", purchased:"0", hidden:"1"};
							}else{
								seat[col][row] = {row:rowLetter, number:labeledNumber, selected:"0", purchased:"0", hidden:"0"};
							}
							
							//Show or Hide Seat
							if(seat[col][row].hidden == 1){
								toBeWritten += "<td><div class=\"seats invisible\" ></div></td>\n";
							}else{
								if(allSold.match(seat[col][row].row + seat[col][row].number + ",")){
									toBeWritten += "<td><img class=\"seats\" id=\"" + seat[col][row].row + seat[col][row].number + "\" src=\"images/chair_purchased.png\" alt=\"Purchased Seat\"></td>\n";
									seat[col][row].purchased = 1;
								}else{
									toBeWritten += "<td><img class=\"seats cursorPointer\" id=\"" + seat[col][row].row + seat[col][row].number + "\" src=\"images/chair_empty.png\" alt=\"Empty Seat\" onclick=\"selectSeat(" + col + "," + row + ")\"></td>\n";
								}
							}
							col++;
							allSeatCount++;
						}
						toBeWritten += "</tr>\n";	
						row++;
					}
					toBeWritten += "</table>\n";
					document.getElementById("seatLayout").innerHTML = toBeWritten;
				}
				
				function selectSeat(col, row){
					if(seat[col][row].purchased != 1){
						if(seat[col][row].selected == 0){
							seat[col][row].selected = 1;
							document.getElementById(seat[col][row].row + seat[col][row].number).src = "images/chair_selected.png";
							document.getElementById(seat[col][row].row + seat[col][row].number).alt = "Selected Seat";
							if(selectedCount == 0){
								document.getElementById("selectedLabel").innerHTML += seat[col][row].row + seat[col][row].number;
							}else{
								document.getElementById("selectedLabel").innerHTML += ", " + seat[col][row].row + seat[col][row].number;
							}
							selectedCount ++;
						}else{
							seat[col][row].selected = 0;
							document.getElementById(seat[col][row].row + seat[col][row].number).src = "images/chair_empty.png";
							document.getElementById("selectedLabel").innerHTML = document.getElementById("selectedLabel").innerHTML.replace(seat[col][row].row + seat[col][row].number, "");
							document.getElementById("selectedLabel").innerHTML = document.getElementById("selectedLabel").innerHTML.replace(", ,", ",");
							document.getElementById("selectedLabel").innerHTML = document.getElementById("selectedLabel").innerHTML.replace(": ,", ": ");
							document.getElementById("selectedLabel").innerHTML = document.getElementById("selectedLabel").innerHTML.replace(" , ", " ");
							if(document.getElementById("selectedLabel").innerHTML.endsWith(", ")){
								document.getElementById("selectedLabel").innerHTML = document.getElementById("selectedLabel").innerHTML.substr(0, document.getElementById("selectedLabel").innerHTML.length-2);
							}
							selectedCount --;
						}
					}
					document.getElementById("formInfo").value = document.getElementById("selectedLabel").innerHTML.replace("Selected Seats: ","");
					activateButtons();
				}
				
				function activateButtons(){
					var temp = document.getElementById("selectedLabel").innerHTML.replace("Selected Seats: ","")
					temp = temp.trim();
					if(temp){
						document.getElementById("submitButton").disabled = false;
						document.getElementById("clearButton").disabled = false;
					}else{
						document.getElementById("submitButton").disabled = true;
						document.getElementById("clearButton").disabled = true;
					}
					document.getElementById("selectedLabel").innerHTML.replace("Selected Seats: ","")
				}

				function clearSelected(){
					var row = 0;
					while(row < ROWS){
						var col = 0;
						while(col < COLS){
							if(seat[col][row].selected == 1){
								selectSeat(col, row);
							}
							col++;
						}
						row++;
					}
				}
			</script>
		</body>
	</html>