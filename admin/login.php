<?php
include("authenticate.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Musical Sign In</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="styles/admin.css">
	</head>
	<body>
		<div class="header">
			<hr id="goldBar">
			<img src="images/logo.png" alt="Tulpehocken Shield Logo" class="leftAlign">
		</div>
		<form action="login.php" method="post">
			<fieldset>
				<legend>Sign In</legend>
				<table>
					<tr>
						<td style="border: 0px !important;">
							<label>Username:</label> 
							<input type="text" name="userLogin" autofocus="autofocus">
							<br>
							<label>Password:</label> 
							<input type="password" name="userPassword">
							<br>
							<label></label> 
							<input type="submit" name="submit" value="Submit">
						</td>
					</tr>
				</table>
			</fieldset>
		</form>

		<?php
			// check to see if user is logging out
			if(isset($_GET['out'])) {
				// destroy session
				session_unset();
				$_SESSION = array();
				unset($_SESSION['user'],$_SESSION['access']);
				session_destroy();
			}

			// check to see if login form has been submitted
			if(isset($_POST['userLogin'])){
				// run information through authenticator
				if(authenticate($_POST['userLogin'],$_POST['userPassword']))
				{
					// authentication passed
					$_SESSION['isSet'] = true;
					header("Location: index.php");
					//die();
				} else {
					// authentication failed
					$_SESSION['isSet'] = false;
					$error = 1;
				}
			}

			// output error to user
			if(isset($error)) echo "<p>Login failed: Incorrect user name, password, or rights.</p>";

			// output logout success
			if(isset($_GET['out'])) echo "<p>Logout successful.</p>";
		?>

	</body>
</html>