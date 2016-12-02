<?php include("db_connection.php");
include("functions.php");
$request_id=$_GET["id"];
$user_id=$_SESSION["user"]["id"];
$query="UPDATE requests SET available_seats=available_seats-1 WHERE id={$request_id}";
mysqli_query($connection,$query);
$query="INSERT INTO requests_users (request_id, user_id) VALUES ({$request_id},{$user_id})";
mysqli_query($connection,$query);
redirect_to("listTrips.php");
?>