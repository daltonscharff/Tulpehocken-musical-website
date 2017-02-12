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
		<body style="width: 800px; height: 1000px;"  onload="limitDropdown()">
			<h1><?php echo $_POST["showTitle"] . " - " . $_POST["showName"];?></h1>
			<p>You selected the seats: <span class="bold" id="seatLabel"><?php echo $_POST["selectedSeats"];?></span></p>
			<p>Please enter all of the following information to complete your reservation.</p>
			<form id="form" action="check.php" method="post">
				<fieldset>
					<legend>Reservation Information</legend>
					<h3 class="centerText">Number of Tickets:</h3>
					<table>
						<tr>
							<td>
								<label>Adult:</label>
								<select id="adultSelect" name="adult">
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Student:</label>
								<select id="studentSelect" name="student">
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Golden Age:</label>
								<select id="goldenSelect" name="golden">
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<br>
								<label>Paid:</label>
								<input type="checkbox" value="1" name="paid">
							</td>
						</tr>
					</table>
					<br>
					<hr>
					<br>
					<h3 class="centerText">Personal Information:</h3>
					<table>
						<tr id="fName">
							<td>
								<label>First Name:</label>
								<input type="text" name="firstName" id="fNameInput" maxlength="40" value="<?php echo $_POST["firstName"];?>">
							</td>
						</tr>
						<tr id="lName">
							<td>
								<label>Last Name:</label>
								<input type="text" name="lastName" id="lNameInput" maxlength="40" value="<?php echo $_POST["lastName"];?>">
							</td>
						</tr>
						<tr id="emailAddr">
							<td>
								<label>Email Address:</label>
								<input type="text" name="email" id="emailAddrInput" maxlength="60" value="<?php echo $_POST["email"];?>">
							</td>
						</tr>
						<tr id="phoneNum">
							<td>
								<label>Phone Number:</label>
								<input type="tel" name="phone" id="phoneNumInput" maxlength="20" value="<?php echo $_POST["phone"];?>">
							</td>
						</tr>
						<tr id="streetTR">
							<td>
								<label>Street:</label>
								<input type="text" name="street" id="streetInput"  maxlength="100" value="<?php echo $_POST["street"];?>">
							</td>
						</tr>
						<tr id="cityTR">
							<td>
								<label>City:</label>
								<input type="text" name="city" id="cityInput" maxlength="50" value="<?php echo $_POST["city"];?>">
							</td>
						</tr>
						<tr id="stateTR">
							<td>
								<label>State:</label>
								<input type="text" name="state" id="stateInput" maxlength="30" value="<?php echo $_POST["state"];?>">
							</td>
						</tr>
						<tr id="zipTR">
							<td>
								<label>ZIP:</label>
								<input type="tel" name="zip" id="zipInput" maxlength="30" value="<?php echo $_POST["zip"];?>">
							</td>
						</tr>
						<tr>
							<td>
								<label></label>
								<button type="button" onclick="checkFields()">Submit</button>
							</td>
						</tr>
						<input type="hidden" name="selectedSeats" value="<?php echo $_POST["selectedSeats"];?>">
						<input type="hidden" name="showSelected" value="<?php echo $_POST["showSelected"];?>">
						<input type="hidden" name="showTitle" value="<?php echo $_POST["showTitle"];?>">
						<input type="hidden" name="showName" value="<?php echo $_POST["showName"];?>">
					</table>
				</fieldset>
			</form>
			<div class="invisible" id="adultSeatNum"><?php echo $_POST["adult"]?></div>
			<div class="invisible" id="studentSeatNum"><?php echo $_POST["student"]?></div>
			<div class="invisible" id="goldenSeatNum"><?php echo $_POST["golden"]?></div>
			
			<script>
				var seatText = document.getElementById("seatLabel").innerHTML;
				if(seatText.match(/,/g)){
					seatText = seatText.match(/,/g);
				}else{
					seatText = "";
				}
				var numOfSeats = seatText.length + 1;				
				function limitDropdown(){
									
					var i;
					for(i = 0; i <= numOfSeats; i++){
						
						if(document.getElementById("adultSeatNum").innerHTML == i){
							document.getElementById("adultSelect").innerHTML += "<option selected value=\"" + i + "\">" + i + "</option>";
						}else{
							document.getElementById("adultSelect").innerHTML += "<option value=\"" + i + "\">" + i + "</option>";
						}
						if(document.getElementById("studentSeatNum").innerHTML == i){
							document.getElementById("studentSelect").innerHTML += "<option selected value=\"" + i + "\">" + i + "</option>";
						}else{
							document.getElementById("studentSelect").innerHTML += "<option value=\"" + i + "\">" + i + "</option>";
						}
						if(document.getElementById("goldenSeatNum").innerHTML == i){
							document.getElementById("goldenSelect").innerHTML += "<option selected value=\"" + i + "\">" + i + "</option>";
						}else{
							document.getElementById("goldenSelect").innerHTML += "<option value=\"" + i + "\">" + i + "</option>";
						}
					}
				}
				function checkFields(){
					var error = 0;
					if(!document.getElementById("fNameInput").value){
						document.getElementById("fName").style.color = "Red";
						error++;
					}else{
						document.getElementById("fName").style.color = "Black";
					}
					if(!document.getElementById("lNameInput").value){
						document.getElementById("lName").style.color = "Red";
						error++;
					}else{
						document.getElementById("lName").style.color = "Black";
					}
					/*if(!document.getElementById("emailAddrInput").value.match("@") || !document.getElementById("emailAddrInput").value.match(".")){
						document.getElementById("emailAddr").style.color = "Red";
						error++;
					}else{
						document.getElementById("emailAddr").style.color = "Black";
					}
					if(document.getElementById("phoneNumInput").value.length < 10){
						document.getElementById("phoneNum").style.color = "Red";
						error++;
					}else{
						document.getElementById("phoneNum").style.color = "Black";
					}
					if(!document.getElementById("streetInput").value){
						document.getElementById("streetTR").style.color = "Red";
						error++;
					}else{
						document.getElementById("streetTR").style.color = "Black";
					}
					if(!document.getElementById("cityInput").value){
						document.getElementById("cityTR").style.color = "Red";
						error++;
					}else{
						document.getElementById("cityTR").style.color = "Black";
					}
					if(!document.getElementById("stateInput").value){
						document.getElementById("stateTR").style.color = "Red";
						error++;
					}else{
						document.getElementById("stateTR").style.color = "Black";
					}
					if(document.getElementById("zipInput").value.length != 5){
						document.getElementById("zipTR").style.color = "Red";
						error++;
					}else{
						document.getElementById("zipTR").style.color = "Black";
					}*/
					
					var total = Number(document.getElementById("adultSelect").value) + Number(document.getElementById("studentSelect").value) + Number(document.getElementById("goldenSelect").value);
					if(total > numOfSeats){
						alert("You have selected more tickets than seats.\n\nPlease make sure that the number of Adult, Student, and Golden Age tickets add up to " + numOfSeats + ".");
						error++;
					}
					if(total < numOfSeats){
						alert("You have selected less tickets than seats.\n\nPlease make sure that the number of Adult, Student, and Golden Age tickets add up to " + numOfSeats + ".");
						error++;
					}
					if(error == 0){
						document.getElementById("form").submit();
					}
				}
			</script>
		</body>
	</html>