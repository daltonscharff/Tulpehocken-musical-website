<?php
	session_start();
	if(!$_SESSION["isSet"]){
		header("Location: login.php");
	}
	if(!isset($_SESSION["tab"])){
		$_SESSION["tab"] = "totalSales.php";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin Musical</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="styles/admin.css">
	</head>
	<body onload="findTab('<?php echo $_SESSION["tab"];?>')">
		<div class="header">
			<hr id="goldBar">
			<img src="images/logo.png" alt="Tulpehocken Shield Logo" class="leftAlign">
			<ul class="rightAlign">
				<li id="tab0" class="selectedTab cursorPointer" onclick="changeTab(0)">Total Sales</li>
				<li id="tab1" class="otherTab cursorPointer" onclick="changeTab(1)">Open Orders</li>
				<li id="tab2" class="otherTab cursorPointer" onclick="changeTab(2)">Find Orders</li>
				<li id="tab3" class="otherTab cursorPointer" onclick="changeTab(3)">Add Orders</li>
				<li id="tab4" class="otherTab cursorPointer" onclick="changeTab(4)">Edit Shows</li>
			</ul>
		</div>
		<p class="rightAlign rightAlignText">You are signed in as <?php echo $_SESSION["user"]." | ";?> <span onclick="logout()" id="logout">Sign Out</span></p>
		<div class="invisible"></div>
		<iframe id="content" onload="resizeIframe()" scrolling="no" src="php/<?php echo $_SESSION["tab"];?>"></iframe>
	</body>
	<script>
		var numOfTabs = 5;
		
		function findTab(tabName){
			if(tabName == "openOrders.php"){
				changeTab(1);
			}else if(tabName == "findOrders.php"){
				changeTab(2);
			}else if(tabName == "addOrders.php"){
				changeTab(3);
			}else if(tabName == "editShows.php"){
				changeTab(4);
			}else{
				changeTab(0);
			}
		}
		
		function changeTab(tab){
			console.log("tab: " + tab);
			var i = 0;
			for(i = 0; i < numOfTabs; i++){
				if(tab == i){
					document.getElementById("tab" + i).className = "selectedTab cursorPointer";
					switch(i){
						case 0:
							document.getElementById("content").src = "php/totalSales.php";
							break;
						case 1:
							document.getElementById("content").src = "php/openOrders.php";
							break;
						case 2:
							document.getElementById("content").src = "php/findOrders.php";
							break;
						case 3:
							//document.getElementById("content").src = "php/addOrders.php";
							document.getElementById("content").src = "php/addOrders/index.php";
							document.getElementById("content").style.height = "3000px";
							document.getElementById("content").style.width = screen.width;
							break;
						case 4:
							document.getElementById("content").src = "php/editShows.php";
							break;
						default:
							break;
					}
					
				}else{
					document.getElementById("tab" + i).className = "otherTab cursorPointer";
				}
			}
		}
		
		function resizeIframe(){
			console.log("resizing...");
			document.getElementById("content").style.height = 0;
			document.getElementById("content").style.height = document.getElementById("content").contentWindow.document.body.scrollHeight +'px';
			document.getElementById("content").style.width = 0;
			document.getElementById("content").style.width = (document.getElementById("content").contentWindow.document.body.scrollWidth + 10) +'px';
		}
		
		function logout(){
			window.location.replace("login.php?out=true");
		}
	</script>
</html>