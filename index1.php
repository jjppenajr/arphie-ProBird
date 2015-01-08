<?php
	session_start();
	if(isset($_SESSION['username'])){
		header("location:index.php");
	}
	include "inc/functions.php";
	$db = new pb_functions();

	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db->login($username,$password);

	}
?>

<html>
	<head>

  	<link rel="stylesheet" href="css/reset.css">
  	<link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/login.css" media="screen" type="text/css" />
		<title>PROBIRD</title>
	</head>
	<body>
		<div id="banner"><img src="css/images/header copy.png">
			<hr>
		</div>
			<div id="background">
				<img src="css/images/bg.jpg">
			</div>	
				
				<div class="wrap">

					<div id="field">

						<form method="post" action="login.php">
							<table width="90%">
							<tr>
								<td><b>Username</b></td>
							</tr>
							<tr>	
								<td><input type="text" name="username" required></td>
							</tr>	
							<tr>
								<td><b>Password</b></td>
							</tr>
							<tr>	
								<td><input type="password" name="password" required>
								<a href="" class="forgot_link">forgot ?</a></td>
							</tr>	
							<tr><td></td>
								
							</tr>
							<tr>	
								<td align="center"><input type="submit" id="submit" value="LOGIN" /></td>
							</tr>	
							</table>
							</form>

					</div>		
				</div>
	</body>

</html>