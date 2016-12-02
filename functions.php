<?php

	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			$output = "<div class=\"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
	
?>
<?php 
function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}
function create_user($username,$password){
  global $connection;
  $query="INSERT INTO users ";
  $query.="(username, hashed_password) ";
  $query.="VALUES ('{$username}', '{$password}')";
  $result=mysqli_query($connection,$query);
}

function login($username,$password){
  global $connection;
  $query="SELECT * FROM users ";
  $query.="WHERE username='{$username}' ";
  $result=mysqli_query($connection,$query);
  if($result_list=mysqli_fetch_assoc($result)){
    if($result_list["hashed_password"]==$password){
      $_SESSION['user']=$result_list;
      redirect_to("index_final.php");
    }else{
      $SESSION["message"]="User password doesn't match.";
    }
    }else{
    $SESSION['message']="User not found.";
  }
 
}
function find_rides($user_id, $number){
  global $connection;
  $query="SELECT * FROM requests ";
  //$query.="LEFT JOIN requests_users ON requests.id=requests_users.request_id LEFT JOIN users ON users.id=requests_users.user_id ";

  
  $query.="WHERE available_seats>0 AND creator_id<>{$user_id} ";
  
  $query.="ORDER BY requests.time DESC ";
  $query.="LIMIT {$number}";
  $result= mysqli_query($connection,$query);
  return $result;
}
function filter_rides($user_id, $number,$start, $destination){
	global $connection;
	$query="SELECT * FROM requests ";
  //$query.="JOIN requests_users ON requests.id=requests_users.request_id ";
	
 $start=mysqli_real_escape_string($connection,$start);
 $destination=mysqli_real_escape_string($connection,$destination);
  
  $query.="WHERE available_seats>0 AND creator_id<>{$user_id} ";
  if ($start!=""){
  $query.="AND start_id='{$start}' ";
  }
  if ($destination!=""){
  $query.="AND dest_id='{$destination}' ";
  }
   $query.="ORDER BY requests.time DESC ";
  $query.="LIMIT {$number}";
  $result= mysqli_query($connection,$query);
  //echo $query;
	return $result;
  

}
function create_request($user_id,$start,$end,$date,$time,$available_seats){
	global $connection;
	$travel_time=date('Y-m-d H:i:s',strtotime($date." ".$time));
	$query="INSERT INTO requests ";
	$query.="(creator_id, start_id, dest_id, travel_time, available_seats) ";
	$query.="VALUES ({$user_id}, '{$start}', '{$end}','{$travel_time}',{$available_seats})";
	$result=mysqli_query($connection,$query);
	$request_id=mysqli_insert_id($connection);
	$query="INSERT INTO requests_users (request_id,user_id) ";
	$query.="VALUES ({$request_id}, {$user_id})";
	mysqli_query($connection,$query);
	
	//echo $query;
	
}
function find_joiners_by_request($request_id){
	global $connection;
	$query="SELECT * FROM requests JOIN requests_users ON requests.id=requests_users.request_id ";
	$query.="JOIN users ON users.id=requests_users.user_id ";
	$query.="WHERE requests.id={$request_id}";
	$result=mysqli_query($connection,$query);
	return $result;
	//echo $query;
}
function joined($request_id,$user_id){
	global $connection;
	$query="SELECT * FROM requests_users WHERE request_id={$request_id} AND user_id={$user_id}";
	$result=mysqli_query($connection,$query);
	return (bool) mysqli_fetch_assoc($result);
	
}

function display_joined_requests($result){
	$product="";
	while($request=mysqli_fetch_assoc($result)){
	
	if (joined($request["id"],$_SESSION["user"]["id"])){
	$travel_time=format_ts($request["travel_time"]);
	$starter=find_user_by_id($request["creator_id"]);
	$product.= "<div class=post-container>";
	$product.= "<div class=\"post-header\">{$request["start_id"]} >> {$request["dest_id"]} </div> ";
	
	$product.= "<div class=\"post-text\">";
	$product.= "Time: {$travel_time} <br />";
	$product.= "Available seats: {$request["available_seats"]} <br />";
	$product.= "Started by: {$starter["username"]} &nbsp; Phone number: {$starter["phone"]}<br />";
	$product.= "People joined: ";
	$joiner_set=find_joiners_by_request($request["id"]);
	while ($joiner=mysqli_fetch_assoc($joiner_set)){
		if ($joiner["id"]==$_SESSION["user"]["id"]){
			$product.="you &nbsp;";
		}else{
		$product.="{$joiner["username"]} &nbsp;";}
	}
	$product.= "<br /> <a  href=\"quit.php?request_id={$request["id"]}\" 
	onclick=\"return confirm('Are you sure you want to quit the trip?');\"> Quit </a>";
	
	
	$product.= "</div>";
	$product.= "</div><br />";
	}}
	echo $product;
	return $product;
}
function format_ts($ts){
	return date("D, M.d, Y  H:i",strtotime($ts));
}

function display_my_requests($result){
	$product="";
	while($request=mysqli_fetch_assoc($result)){
	$travel_time=format_ts($request["travel_time"]);
	
	$product.= "<div class=post-container>";
	$product.= "<div class=\"post-header\">{$request["start_id"]} >> {$request["dest_id"]} </div> ";
	
	$product.= "<div class=\"post-text\">";
	$product.= "Time: {$travel_time} <br />";
	$product.= "Available seats: {$request["available_seats"]} <br />";
	$product.= "Started by you <br />";
	$product.= "Current passengers: ";
	$joiner_set=find_joiners_by_request($request["id"]);
	while ($joiner=mysqli_fetch_assoc($joiner_set)){
		if ($joiner["id"]==$_SESSION["user"]["id"]){
			$product.="you &nbsp;";
		}else{
		$product.="{$joiner["username"]} &nbsp;";}
	}
	if (joined($request["id"],$_SESSION["user"]["id"])){
	$product.= "<br /> <a  href=\"quit.php?request_id={$request["id"]}\" 
	onclick=\"return confirm('Are you sure you want to quit the trip?');\"> Quit </a>";}
	$product.= "</div>";
	$product.= "</div><br />";
	}
	echo $product;
	return $product;
}

function display_requests($result){
	$user_id=$_SESSION["user"]["id"];
	$product="<b>Suggested trips:</b>";
	while($request=mysqli_fetch_assoc($result)){
		if (!joined($request["id"],$user_id)){
	$travel_time=format_ts($request["travel_time"]);
	$starter=find_user_by_id($request["creator_id"]);
	$product.= "<h5>{$request["start_id"]} >> {$request["dest_id"]}</h5>";
	$product.= "<ul>";
	$product.= "<li>Time: {$travel_time}</li>";
	$product.= "<li>Available seats: {$request["available_seats"]}</li>";
	$product.= "<li>Started by: {$starter["username"]} &nbsp,";
	$product.= "Phone number: {$starter["phone"]}</li>";
	$product.= "<li>Current passengers: ";
	$joiner_set=find_joiners_by_request($request["id"]);
	while ($joiner=mysqli_fetch_assoc($joiner_set)){
		if ($joiner["id"]==$_SESSION["user"]["id"]){
			$product.="you &nbsp;";
		}else{
		$product.="{$joiner["username"]} &nbsp;";}
	}
	$product.= "</li>";
	
	$product.="</ul>";
	$product.= "<a href=\"join.php?id={$request["id"]}\"> Join </a>";
	//$product.= "<br />";
		}
	}
	echo $product;
	return $product;
}

function find_user_by_id($id){
	global $connection;
	$query="SELECT * FROM users WHERE id={$id}";
	$result=mysqli_query($connection,$query);
	$user=mysqli_fetch_assoc($result);
	return $user;
	
	
}
function find_requests_by_creator($id){
	global $connection;
	$query="SELECT * FROM requests WHERE creator_id={$id} ORDER BY time DESC";
	$result=mysqli_query($connection,$query);
	return $result;
	
}



function display_requests_list($result){
	$product="";
	$user_id=$_SESSION["user"]["id"];
	while($request=mysqli_fetch_assoc($result)){
		if (!joined($request["id"],$user_id)){
	$travel_time=format_ts($request["travel_time"]);
	$starter=find_user_by_id($request["creator_id"]);
	$product.= "<div class=post-container>";
	$product.= "<div class=\"post-header\">{$request["start_id"]} >> {$request["dest_id"]} </div> ";
	
	$product.= "<div class=\"post-text\">";
	$product.= "Time: {$travel_time} <br />";
	$product.= "Available seats: {$request["available_seats"]} <br />";
	$product.= "Starter: {$starter["username"]} &nbsp";
	$product.= "Phone number: {$starter["phone"]}<br />";
	$product.= "Current passengers: ";
	$joiner_set=find_joiners_by_request($request["id"]);
	while ($joiner=mysqli_fetch_assoc($joiner_set)){
		$product.="{$joiner["username"]} &nbsp;";
		
	}
	$product.= "<a href=\"join.php?id={$request["id"]}\"> Join </a>";
	$product.= "</div>";
	$product.= "</div><br />";
		}
	}
	echo $product;
	return $product;
}
?>
