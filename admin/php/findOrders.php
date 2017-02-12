<?php include "../connection.php"; $_SESSION["tab"] = "findOrders.php";?>
<html>
<?php include "../header.php";?>
<body>
	<span><b>Search:</b></span>
	<input id="searchField" style="width:300px;" type="text" onclick="this.select()">
	<button onclick="search()">Search</button>
	<button onclick="search('%')">Clear</button>
	<script>
	var filterNames = ["order_filter", "showName_filter", "name_filter", "email_filter", "phone_filter", "seats_filter"];
	var filterValues = [1,1,1,1,1,1];
	
	document.getElementById("searchField").addEventListener("keyup", function(event){ event.preventDefault(); if(event.keyCode == 13){search();}});
	
	function search(str){
		if(str == '%'){
			document.getElementById('searchField').value = '';
			filterValues = [1,1,1,1,1,1];
			ajaxTableResponse('search_findOrders.php', str, filterNames, filterValues);
			var i=0;
			for(i = 0; i < filterValues.length; i++){
				document.getElementById("cb" + i).checked = "true";
			}
		}else{
			ajaxTableResponse('search_findOrders.php', document.getElementById("searchField").value, filterNames, filterValues);
		}
	}
		
	function checkboxClick(boxNum){
		if(document.getElementById("cb" + boxNum).checked){
			filterValues[boxNum] = 1;
		}else{
			filterValues[boxNum] = 0;
		}
	}
	</script>
	<br>
	<table style="width: 500px; font-size:12px;">
		<tr>
			<td style="border: 0px;"><b>Filters:</b></td>
			<td style="border: 0px;">Order#<br><input id="cb0" type="checkbox" checked onclick="checkboxClick(0)"></td>
			<td style="border: 0px;">Show Name<br><input id="cb1" type="checkbox" checked onclick="checkboxClick(1)"></td>
			<td style="border: 0px;">Name<br><input id="cb2" type="checkbox" checked onclick="checkboxClick(2)"></td>
			<td style="border: 0px;">Email<br><input id="cb3" type="checkbox" checked onclick="checkboxClick(3)"></td>
			<td style="border: 0px;">Phone#<br><input id="cb4" type="checkbox" checked onclick="checkboxClick(4)"></td>
			<td style="border: 0px;">Seats<br><input id="cb5" type="checkbox" checked onclick="checkboxClick(5)"></td>
		</tr>
	</table>
	<br><br>
	<div id="SearchData">
	<script>document.getElementById("SearchData").style.width = window.screen.width - 100;</script>
	<table>
		<tr class="bold">
			<td>
				Order #
			</td>
			<td>
				Show Name
			</td>
			<td>
				Name
			</td>
			<td>
				Email
			</td>
			<td>
				Phone #
			</td>
			<td>
				Address
			</td>
			<td>
				Date Ordered
			</td>
			<td>
				Adult
			</td>
			<td>
				Student
			</td>
			<td>
				Golden Age
			</td>
			<td>
				Seats
			</td>
			<td>
				Paid
			</td>
			<td>
				Remove Order
			</td>
		</tr>
		<?php
		$sql = "SELECT * FROM seatsSold;";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)){
			strtoupper($row["state"]) == "PENNSYLVANIA" ? $state = "PA" : $state = $row["state"];
			?>
				<tr style="font-size: .85em">
					<td>
						<p><?php echo $row["ID"];?></p>
					</td>
					<td>
						<p><?php echo $row["showName"];?></p>
					</td>
					<td>
						<p><?php echo $row["firstName"] . " " . $row["lastName"];?></p>
					</td>
					<td>
						<p><?php echo $row["email"];?></p>
					</td>
					<td>
						<p><?php echo $row["phone"];?></p>
					</td>
					<td>
						<p><?php echo $row["street"] . "<br>" . $row["city"] . ", " . $state . " " . $row["zip"];?></p>
					</td>				
					<td>
						<p><?php echo $row["time"];?></p>
					</td>
					<td>
						<p><?php echo $row["adult"];?></p>
					</td>
					<td>
						<p><?php echo $row["student"];?></p>
					</td>
					<td>
						<p><?php echo $row["golden"];?></p>
					</td>
					<td>
						<p><?php echo $row["seats"];?></p>
					</td>
					<td>
						<input type="checkbox" <?php if($row["paid"] == 1){ echo "checked";} ?> onclick="ajaxNoResponse('togglePaid_findOrders.php?id=<?php echo $row["ID"];?>')">
					</td>
					<td>
						<button onclick="ajaxNoResponse('removeOrder_openOrders.php?id=<?php echo $row["ID"];?>&showName=<?php echo $row["showName"];?>&seats=<?php echo str_replace(' ', '', $row["seats"]);?>', 'findOrders.php')">Remove</button>
					</td>
				</tr>
			<?php
		}
		?>
	</table>
	</div>
</body>
</html>