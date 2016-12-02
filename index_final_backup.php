<?php include("functions.php");
include("db_connection.php");?>
<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete</title>
	
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Create Trips</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" type="text/css" href="createTrip.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
    
	<script>
	function display_requests() {
		//console.log('ok');
  var xhttp = new XMLHttpRequest();
  //var start_value = ''
  xhttp.onreadystatechange = function() {
	  
	 // start_value=start.options[start.selectedIndex].value;
	  //console.log('start:'+start_value)
		//var end=document.getElementById("end").value;
		//console.log('end:'+end)
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("requestDisplay").innerHTML = this.responseText;
	 //alert(this.responseText);
    }
  };
  var start=document.getElementById("start");
  xhttp.open("GET", "get_requests.php?start="+String(start.options[start.selectedIndex].value)+"&end="+String(document.getElementById("end").value), true);
  xhttp.send();
}  
	function display_route(){
		var start=document.getElementById("start");
		//alert(start.options[start.selectedIndex].value);
		var end=document.getElementById("end").value;
		alert(end);
	}
	
</script>
	
  </head>
  <body onload="display_requests();">
  <div id="map"></div>
  
  <?php include("options.php");?>
  
      <div id="right-panel">
  		<div>
        <form action="create_request.php" method="POST">
  		<h1>New Trip</h1>
  		<b>From:</b>
  		<select name="start" id="start" onblur="display_requests()">
		  <!--<option value=""></option>-->
  		  <option value="NYU Abu Dhabi Welcome Center - Abu Dhabi - United Arab Emirates">NYUAD Welcome center</option>
  		  <option value="embassy of the people's republic of china - al mushrif - abu dhabi">Chinese Embassy Abu Dhabi</option>
  		  <option value="embassy of the united states, embassies district, abu dhabi">United States Embassy Abu Dhabi</option>
  		  <option value="Yas Mall, Yas Island">Yas Mall</option>
  		</select>
  		</br>
  		</br>
  		<b>To:</b>
        <input name="end" id="end" class="controls" type="text"
            placeholder="Enter a location" onblur="display_requests(); display_route();">
  		</br>
  		</br>
  		<b>Date: <input name="date" type="text" id="datepicker"></b>
  		</br>
  		</br>
  		<b>Time:</b>
  		<select name="time" id="time">
  		  <option value="12:00 AM">12:00 AM</option>
  		  <option value="12:30 AM">12:30 AM</option>
  		  <option value="01:00 AM">01:00 AM</option>
  		  <option value="01:30 AM">01:30 AM</option>
  		  <option value="02:00 AM">02:00 AM</option>
  		  <option value="02:30 AM">02:30 AM</option>
  		  <option value="03:00 AM">03:00 AM</option>
  		  <option value="03:30 AM">03:30 AM</option>
  		  <option value="04:00 AM">04:00 AM</option>
  		  <option value="04:30 AM">04:30 AM</option>
  		  <option value="05:00 AM">05:00 AM</option>
  		  <option value="05:30 AM">05:30 AM</option>
  		  <option value="06:00 AM">06:00 AM</option>
  		  <option value="06:30 AM">06:30 AM</option>
  		  <option value="07:00 AM">07:00 AM</option>
  		  <option value="07:30 AM">07:30 AM</option>
  		  <option value="08:00 AM">08:00 AM</option>
  		  <option value="08:30 AM">08:30 AM</option>
  		  <option value="09:00 AM">09:00 AM</option>
  		  <option value="09:30 AM">09:30 AM</option>
  		  <option value="10:00 AM">10:00 AM</option>
  		  <option value="10:30 AM">10:30 AM</option>
  		  <option value="11:00 AM">11:00 AM</option>
  		  <option value="11:30 AM">11:30 AM</option>
  		  <option value="12:00 PM">12:00 PM</option>
  		  <option value="12:30 PM">12:30 PM</option>
  		  <option value="01:00 PM">01:00 PM</option>
  		  <option value="01:30 PM">01:30 PM</option>
  		  <option value="02:00 PM">02:00 PM</option>
  		  <option value="02:30 PM">02:30 PM</option>
  		  <option value="03:00 PM">03:00 PM</option>
  		  <option value="03:30 PM">03:30 PM</option>
  		  <option value="04:00 PM">04:00 PM</option>
  		  <option value="04:30 PM">04:30 PM</option>
  		  <option value="05:00 PM">05:00 PM</option>
  		  <option value="05:30 PM">05:30 PM</option>
  		  <option value="06:00 PM">06:00 PM</option>
  		  <option value="06:30 PM">06:30 PM</option>
  		  <option value="07:00 PM">07:00 PM</option>
  		  <option value="07:30 PM">07:30 PM</option>
  		  <option value="08:00 PM">08:00 PM</option>
  		  <option value="08:30 PM">08:30 PM</option>
  		  <option value="09:00 PM">09:00 PM</option>
  		  <option value="09:30 PM">09:30 PM</option>
  		  <option value="10:00 PM">10:00 PM</option>
  		  <option value="10:30 PM">10:30 PM</option>
  		  <option value="11:00 PM">11:00 PM</option>
  		  <option value="11:30 PM">11:30 PM</option>
  		</select>
  		</br>
  		</br>
        <b>Number of people</b>
		<select name="available_seats" id="end">
          <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <!--<option value="4">4</option>-->
		  <!--<option value="5">5</option>-->
		</select>
  		</br>
  		<input type="submit" name='submit' id="submit" value="Create">
		<b>Suggested Trips</b>
		<div id="requestDisplay"></div>
    </form>
  		</div>

  	   <!-- <div id="directions-panel"></div> -->
	   
      </div>
	  

    
	
    <script>
    $( function() {
      $( "#datepicker" ).datepicker();
      } );

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 24.5303, lng: 54.4452},
    zoom: 13
  });
  var input = /** @type {!HTMLInputElement} */(
      document.getElementById('end'));


  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  //var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    //infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    //infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  var geocoder = new google.maps.Geocoder();

  document.getElementById('submit').addEventListener('click', function() {
    geocodeAddress(geocoder, map);
  });
}

function geocodeAddress(geocoder, resultsMap) {
  var address = document.getElementById('end').value;
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
      });
      alert(marker.position)
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
  
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJnUP_VOxG11GQ9TXLNaro3nP1BViYdto&libraries=places&callback=initMap"
        async defer></script>
  </body>
</html>
