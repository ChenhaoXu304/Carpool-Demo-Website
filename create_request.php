<?php 
include("functions.php");
include('db_connection.php');
if(isset($_POST["submit"])){
	$available_seats=4-(int) $_POST["available_seats"];
	create_request($_SESSION["user"]["id"],$_POST["start"],$_POST["end"],$_POST["date"],$_POST["time"],$available_seats);
} 
redirect_to("index_final.php");?>