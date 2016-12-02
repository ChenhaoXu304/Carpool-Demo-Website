<?php include("functions.php");
include("db_connection.php");?>
<?php
	if(isset($_POST["submit"])){
		login($_POST["username"],$_POST["password"]);
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>All Trips</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" type="text/css" href="login.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>
  
  <body>
  <div id="options">
  	<div id="cabpool">NYUAD CabPool</div>
  </div>
  <div class="clear"></div>
  <div class=fixedwidth>
  	<div id="loginForm">
  		Sign in
		<form action="login.php" method="POST" id="fdff">
		<input type="text" name="username" placeholder="username" id="username">
  		</br>
  		</br>
  		<input type="password" name="password" placeholder="password" id="password">
  		<br><br>
  		<input type="submit" name="submit" value="Login" id="submit">
	</form> 
	</div>
  </div>
  </body>
</html>