<?php include "../connection.php"; $_SESSION["tab"] = "editShows.php";?>
<html>
<?php include "../header.php";?>
<body>
	<table id="editShowsTable">
		<tr class="bold">
			<td>
				Show Name
			</td>
			<td>
				Active
			</td>
			<td>
				Unique ID
			</td>
			<td>
				Show Title
			</td>
			<td>
				Modify
			</td>
		</tr>
		<?php
		$sql = "SELECT * FROM shows";
		$result = mysqli_query($conn, $sql);
		$count = 1;
		while($row = mysqli_fetch_assoc($result)){
			if($row["active"] == 1){
				$checked = "checked";
			}else{
				$checked = "";
			}
			?>
			<tr>
				<td>
					<input type="text" name="showName_<?php echo $count;?>" id="showName_<?php echo $count;?>" oninput="updateFields(<?php echo $count;?>)" value="<?php echo $row["showName"];?>">
				</td>
				<td>
					<input type="checkbox" name="active_<?php echo $count;?>" id="active_<?php echo $count;?>" onclick="updateFields(<?php echo $count;?>)" <?php echo $checked;?>>
				</td>
				<td>
					<input type="text" name="showID_<?php echo $count;?>" id="showID_<?php echo $count;?>" disabled value="<?php echo $row["showID"];?>">
				</td>
				<td>
					<input type="text" name="showTitle_<?php echo $count;?>" id="showTitle_<?php echo $count;?>" oninput="updateFields(<?php echo $count;?>)" value="<?php echo $row["showTitle"];?>">
				</td>
				<td>
					<button onclick="ajaxNoResponse(removeButtonFunct(<?php echo $count;?>))">Remove</button>
				</td>
			</tr>
			<?php
			$count++;
		}
		?>
		<tr>
			<td>
				<input type="text" name="showName_<?php echo $count;?>" id="showName_<?php echo $count;?>">
			</td>
			<td>
				<input type="checkbox" name="active_<?php echo $count;?>" id="active_<?php echo $count;?>">
			</td>
			<td>
				<input type="text" name="showID_<?php echo $count;?>" id="showID_<?php echo $count;?>">
			</td>
			<td>
				<input type="text" name="showTitle_<?php echo $count;?>" id="showTitle_<?php echo $count;?>">
			</td>
			<td>
				<button id="addButton" onclick="addButtonFunct(<?php echo $count;?>)">Add</button>
			</td>
		</tr>
	</table>
	<p id="error"></p>
	<br>
</body>
<script>	
	function updateFields(count){
		ajaxErrorResponse("updateFields_editShow.php?showName=" + document.getElementById("showName_" + count).value + "&active=" + document.getElementById("active_" + count).checked + "&showID=" + document.getElementById("showID_" + count).value + "&showTitle=" + document.getElementById("showTitle_" + count).value, "editShows.php");
		console.log("updateFields_editShow.php?showName=" + document.getElementById("showName_" + count).value + "&active=" + document.getElementById("active_" + count).checked + "&showID=" + document.getElementById("showID_" + count).value + "&showTitle=" + document.getElementById("showTitle_" + count).value, "editShows.php");
	}
	function removeButtonFunct(count){
		ajaxErrorResponse("removeRow_editShow.php?showID=" + document.getElementById("showID_" + count).value, "editShows.php");
	}
	function addButtonFunct(count){
		ajaxErrorResponse("addRow_editShow.php?showName=" + document.getElementById("showName_" + count).value + "&active=" + document.getElementById("active_" + count).checked + "&showID=" + document.getElementById("showID_" + count).value + "&showTitle=" + document.getElementById("showTitle_" + count).value, "editShows.php");
	}
	
	function checkedBox(count){
		if(document.getElementById("active_" + count).checked){
			document.getElementById("img_" + count).src = "images/deleteButton_disabled.png";
			document.getElementById("img_" + count).className = "deleteButton";
			document.getElementById("x_" + count).onclick = "";
		}else{
			document.getElementById("img_" + count).src = "images/deleteButton.png";
			document.getElementById("img_" + count).className = "deleteButton cursorPointer";
			document.getElementById("x_" + count).onclick = function(){deleteRow(count)};
		}
	}
</script>
</html>