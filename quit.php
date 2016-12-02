<?php include("functions.php");
include("db_connection.php");
$request_id=$_GET["request_id"];
$user_id=$_SESSION["user"]["id"];
$query="DELETE FROM requests_users WHERE request_id={$request_id} AND user_id={$user_id}";
mysqli_query($connection,$query);
redirect_to("my_requests.php");
?>