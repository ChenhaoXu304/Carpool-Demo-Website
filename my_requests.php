<?php 
include("functions.php");
include('db_connection.php');?>
<?php
	$user_id=$_SESSION["user"]["id"];
	$request_set=find_requests_by_creator($user_id);
	$total_set=find_rides($user_id,20);
	
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>All Trips</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" type="text/css" href="listTrips.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>
  <body>
  <?php include("options.php");?>
  	<div class="fixedwidth">
  	
  		<div id="header">Trips I Started/Joined</div>
		
		<?php display_my_requests($request_set);
		display_joined_requests($total_set);
		?>
  		

  		
  		
  	</div>
	
	
    
    <script>
 
    </script>
    <!--<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyvyoOniitPWzl0WpqhdQV0zfOrhEGPLo&callback=initMap">
    </script>
    -->
  </body>
</html>