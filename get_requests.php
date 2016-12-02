<?php include("functions.php");
include("db_connection.php");
$user_id=$_SESSION["user"]["id"];
	$result=filter_rides($user_id,50,$_GET["start"],$_GET["end"]);
	display_requests($result);
?>