<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  </head>
  <body>
    <div id="map">
    </div>
    <div id="right-panel">
		<div>
		<form action="create_request.php" method="POST">
		<h1>New Trip</h1>
		<b>Start:</b>
		<select name="start" id="start">
		  <option value="nyu abu dhabi saadiyat island">NYUAD Welcome center</option>
		  <option value="embassy of the people's republic of china - al mushrif - abu dhabi">Chinese Embassy Abu Dhabi</option>
		  <option value="embassy of the united states, embassies district, abu dhabi">United States Embassy Abu Dhabi</option>
		  <option value="Yas Mall, Yas Island">Yas Mall</option>
		</select>
		</br>
		</br>
		<b>End:</b>
		<select name="end" id="end">
		  <option value="nyu abu dhabi saadiyat island">NYUAD Welcome Center</option>
		  <option value="embassy of the people's republic of china - al mushrif - abu dhabi">Chinese Embassy Abu Dhabi</option>
		  <option value="Embassy of the United States, Embassies District, Abu Dhabi">United States Embassy Abu Dhabi</option>
		  <option value="Yas Mall, Yas Island">Yas Mall</option>
		</select>
		</br>
		</br>
		<b>Date: <input name="date" type="text" id="datepicker"></b>
		</br>
		</br>
		<b>Time:</b>
		<select name="time" id="end">
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
		<b>Available Seats (including yourself)</b>
		<select name="available_seats" id="end">
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		</select>
		</br>
		<input type="submit" name="submit" id="submit" value="Create">
		</form>
		</div>
		
	   <!-- <div id="directions-panel"></div> -->
    </div>
    
    <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: 24.54, lng: 54.4}
        });
        directionsDisplay.setMap(map);

        document.getElementById('submit').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
        
        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
      }
      
      $( function() {
    	$( "#datepicker" ).datepicker();
  		} );

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        /*var waypts = [];
        var checkboxArray = document.getElementById('waypoints');
        for (var i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
          }
        }*/

        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            /*
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
            */
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyvyoOniitPWzl0WpqhdQV0zfOrhEGPLo&callback=initMap">
    </script>
  </body>
</html>