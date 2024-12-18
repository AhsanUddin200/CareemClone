<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    // For demonstration, assume user_id = 1
    $_SESSION['user_id'] = 1; 
    // In a real app, you'd redirect to login.php if not logged in.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Real-time Driver Tracking & History</title>
<style>
body { 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    margin: 0; 
    padding: 0; 
    background: #f0f4f8; 
}

.header-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.logo {
    display: flex;
    align-items: center;
    font-size: 24px;
    color: #4a4a4a;
}

.logo-icon {
    margin-right: 8px;
}

.nav-links a {
    margin: 0 15px;
    text-decoration: none;
    color: #4a4a4a;
    font-weight: 500;
}

.nav-links a:hover {
    color: #007bff;
}

.sign-in {
    background: #00b894;
    color: #fff;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    transition: background 0.3s;
}

.sign-in:hover {
    background: #009b77;
}

.language-selector {
    margin-left: 20px;
    font-weight: 500;
}
/* Existing Styles */
.container { 
    width: 80%; 
    margin: 20px auto; 
    background: #fff; 
    padding: 30px; 
    border-radius: 10px; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
}


.container { 
    width: 80%; 
    margin: 20px auto; 
    background: #fff; 
    padding: 30px; 
    border-radius: 10px; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
}

#map { 
    height: 300px; 
    margin-bottom: 20px; 
    border: 2px solid #ddd; 
    border-radius: 8px; 
    overflow: hidden; 
}

input[type=text] {
    width: 48%; 
    padding: 12px; 
    margin-bottom: 15px; 
    box-sizing: border-box; 
    border: 1px solid #ccc; 
    border-radius: 5px; 
    margin-right: 2%;
    transition: border 0.3s;
}

input[type=text]:focus {
    border-color: #007bff; 
    outline: none; 
}

button { 
    padding: 12px 25px; 
    background: #28a745; 
    color: #fff; 
    border: none; 
    border-radius: 5px; 
    cursor: pointer; 
    transition: background 0.3s;
}

button:hover { 
    background: #218838; 
}

.message { 
    margin: 15px 0; 
    color: #007bff; 
    font-weight: bold; 
}

#routeInfo, #etaInfo, #progressIndicator { 
    margin-top: 20px; 
}

#etaInfo { 
    color: #28a745; 
    font-weight: bold; 
}

#progressIndicator { 
    color: #555; 
}

.modal-overlay, .modal-popup {
    display: none; 
    position: fixed; 
    top: 0; 
    left: 0; 
    width: 100%; 
    height: 100%; 
}

.modal-overlay {
    background: rgba(0, 0, 0, 0.5); 
    z-index: 1000;
}

.modal-popup {
    z-index: 1100; 
    background: #fff; 
    width: 400px; 
    padding: 20px; 
    border-radius: 8px; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%);
    max-height: 70%; 
    overflow: auto;
}

.close-btn {
    float: right; 
    background: #dc3545; 
    color: #fff; 
    padding: 8px; 
    border: none; 
    border-radius: 4px; 
    cursor: pointer; 
    transition: background 0.3s;
}

.close-btn:hover { 
    background: #c82333; 
}

/* Chat and driver popup styles */
.chat-box { 
    border: 1px solid #ccc; 
    border-radius: 4px; 
    padding: 10px; 
    max-height: 200px; 
    overflow: auto; 
    background: #fafafa; 
}

.chat-message { 
    margin-bottom: 10px; 
}

.user-msg { color: #007bff; }
.driver-msg { color: #28a745; }

.chat-input { 
    display: flex; 
    margin-top: 10px; 
}

.chat-input input[type=text] { 
    flex: 1; 
    padding: 10px; 
    border: 1px solid #ccc; 
    border-radius: 4px; 
    margin-right: 5px; 
}

.chat-input button { 
    padding: 10px; 
    background: #007bff; 
    color: #fff; 
    border: none; 
    border-radius: 4px; 
    cursor: pointer; 
    transition: background 0.3s;
}

.chat-input button:hover { 
    background: #0069d9; 
}

#assignBtn { 
    margin-top: 10px; 
    background: #ffc107; 
}

#assignBtn:hover { 
    background: #e0a800; 
}

.history-btn {
    background: #17a2b8; 
    margin-top: 20px; 
}

.history-btn:hover { 
    background: #138496; 
}

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <span class="logo-icon">🚖</span>
            <span class="logo-text">careem</span>
        </div>
        <nav class="nav-links">
        <a href="services.php">Services</a>
            <a href="partner.php">Partners</a>
            <a href="aboutus.php">About Us</a>
         
        </nav>
        <div>
            <a href="logout.php" class="">logout</a>
            <span class="language-selector">English</span>
        </div>
    </div>
</header>

<div class="container">
  <div class="message" id="msgArea"></div>
  <div id="map"></div>
  <input type="text" id="pickupInput" placeholder="Pickup Location">
  <input type="text" id="dropoffInput" placeholder="Drop-off Location">
  <br>
  <button id="requestRideBtn">Request Ride</button>
  <button class="history-btn" id="viewHistoryBtn">View History</button>

  <div id="routeInfo"></div>
  <div id="etaInfo"></div>
  <div id="progressIndicator"></div> <!-- Added progress indicator -->
</div>

<!-- Driver Message Popup -->
<div class="modal-overlay" id="driverMsgOverlay"></div>
<div class="modal-popup" id="driverMsgPopup">
  <button class="close-btn" id="closeDriverMsg">&times;</button>
  <p>Driver has proposed a price!</p>
  <button id="openChatBtn">Open Chat</button>
</div>

<!-- Chat Modal -->
<div class="modal-overlay" id="chatOverlay"></div>
<div class="modal-popup" id="chatPopup" style="width:400px;">
  <button class="close-btn" id="closeChat">&times;</button>
  <h3>Chat with Driver</h3>
  <div class="chat-box" id="chatBox"></div>
  <div class="chat-input">
    <input type="text" id="chatInput" placeholder="Your message...">
    <button id="chatSendBtn">Send</button>
  </div>
  <button id="assignBtn" hidden>Assign Driver</button>
</div>

<!-- History Modal -->
<div class="modal-overlay" id="historyOverlay"></div>
<div class="modal-popup" id="historyPopup">
  <button class="close-btn" id="closeHistory">&times;</button>
  <h3>Your Ride History</h3>
  <div id="historyContent"></div>
</div>

<script>
// Initialize map
var map = L.map('map').setView([24.8607, 67.0011], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{
  maxZoom:19,
  attribution:'&copy; OpenStreetMap'
}).addTo(map);

// Add random cars and bikes on map
var carIcon = L.icon({
  iconUrl:'https://cdn-icons-png.flaticon.com/512/481/481159.png',
  iconSize:[30,30]
});
var bikeIcon = L.icon({
  iconUrl:'https://cdn-icons-png.flaticon.com/512/2329/2329066.png',
  iconSize:[30,30]
});
L.marker([24.8610,67.0020],{icon:carIcon}).addTo(map).bindPopup("Car");
L.marker([24.8620,67.0005],{icon:carIcon}).addTo(map).bindPopup("Car");
L.marker([24.8630,67.0030],{icon:bikeIcon}).addTo(map).bindPopup("Bike");
L.marker([24.8640,67.0040],{icon:bikeIcon}).addTo(map).bindPopup("Bike");

var msgArea = document.getElementById('msgArea');
var requestRideBtn = document.getElementById('requestRideBtn');
var driverMsgOverlay = document.getElementById('driverMsgOverlay');
var driverMsgPopup = document.getElementById('driverMsgPopup');
var openChatBtn = document.getElementById('openChatBtn');
var chatOverlay = document.getElementById('chatOverlay');
var chatPopup = document.getElementById('chatPopup');
var chatBox = document.getElementById('chatBox');
var chatInput = document.getElementById('chatInput');
var chatSendBtn = document.getElementById('chatSendBtn');
var assignBtn = document.getElementById('assignBtn');
var routeInfo = document.getElementById('routeInfo');
var etaInfo = document.getElementById('etaInfo');
var closeDriverMsg = document.getElementById('closeDriverMsg');
var closeChat = document.getElementById('closeChat');
var viewHistoryBtn = document.getElementById('viewHistoryBtn');
var historyOverlay = document.getElementById('historyOverlay');
var historyPopup = document.getElementById('historyPopup');
var historyContent = document.getElementById('historyContent');
var closeHistory = document.getElementById('closeHistory');
var progressIndicator = document.getElementById('progressIndicator'); // Added progress indicator variable

var currentRideId = null;
var fareEstimate = null;
var driverProposedFare = null;
var fareAgreed = false;

// AJAX helper
function postData(url, data) {
  return fetch(url, {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: new URLSearchParams(data)
  }).then(r => r.json());
}

function addMessage(msg, sender) {
  var div = document.createElement('div');
  div.className = 'chat-message ' + (sender === 'user' ? 'user-msg' : 'driver-msg');
  div.textContent = (sender === 'user' ? 'You: ' : 'Driver: ') + msg;
  chatBox.appendChild(div);
  chatBox.scrollTop = chatBox.scrollHeight;
}

requestRideBtn.addEventListener('click', function() {
  var pickup = document.getElementById('pickupInput').value;
  var dropoff = document.getElementById('dropoffInput').value;
  if (!pickup || !dropoff) {
    msgArea.textContent = "Please enter pickup and drop-off.";
    return;
  }
  msgArea.textContent = "Requesting ride...";
  postData('request_ride.php', {pickup: pickup, dropoff: dropoff}).then(res => {
    if (res.error) {
      msgArea.textContent = res.error;
    } else {
      currentRideId = res.ride_id;
      fareEstimate = res.fare_estimate;
      msgArea.textContent = "Ride requested! Waiting for driver to propose price...";
      // After delay simulate driver message popup
      setTimeout(function() {
        driverProposedFare = fareEstimate * 1.2; // driver proposes higher
        driverMsgOverlay.style.display = 'block';
        driverMsgPopup.style.display = 'block';
      }, 3000);
    }
  });
});

openChatBtn.addEventListener('click', function() {
  driverMsgOverlay.style.display = 'none';
  driverMsgPopup.style.display = 'none';

  chatOverlay.style.display = 'block';
  chatPopup.style.display = 'block';
  addMessage("I can do this ride for $" + driverProposedFare.toFixed(2) + ". How about that?", 'driver');
});

chatSendBtn.addEventListener('click', function() {
  var msg = chatInput.value.trim();
  if (!msg) return;
  addMessage(msg, 'user');
  chatInput.value = '';
  var m = msg.match(/(\d+(\.\d+)?)/);
  if (m) {
    var offer = parseFloat(m[1]);
    setTimeout(function() {
      if (offer >= driverProposedFare * 0.9) {
        addMessage("Okay, let's agree on $" + offer.toFixed(2) + ". Click 'Assign Driver' now!", 'driver');
        fareAgreed = true;
        assignBtn.hidden = false;
        assignBtn.dataset.fare = offer.toFixed(2);
      } else {
        addMessage("That's too low. I still want around $" + driverProposedFare.toFixed(2) + ".", 'driver');
      }
    }, 1500);
  } else {
    setTimeout(function() {
      if (!fareAgreed) {
        addMessage("Please give me a fair price near $" + driverProposedFare.toFixed(2) + ".", 'driver');
      }
    }, 1500);
  }
});

assignBtn.addEventListener('click', function() {
  var finalFare = parseFloat(assignBtn.dataset.fare);
  postData('finalize_ride.php', {ride_id: currentRideId, final_fare: finalFare}).then(res => {
    if (res.error) {
      addMessage("Error: " + res.error, 'driver');
    } else {
      addMessage("Driver assigned! Fare: $" + finalFare.toFixed(2), 'driver');
      // Close chat and show route and ETA
      setTimeout(function() {
        chatOverlay.style.display = 'none';
        chatPopup.style.display = 'none';
        showRoute(finalFare);
      }, 1500);
    }
  });
});

function showRoute(finalFare) {
  msgArea.textContent = "Ride assigned at $" + finalFare.toFixed(2) + ". Below is your route.";
  
  // Draw route line
  var pickup = [24.8607, 67.0011];
  var dropoff = [24.8707, 67.0111];
  var line = L.polyline([pickup, dropoff], {color: 'blue'}).addTo(map);
  map.fitBounds(line.getBounds());

  // Show distance
  var dist = calcDistance(pickup[0], pickup[1], dropoff[0], dropoff[1]);
  routeInfo.textContent = "Approx Distance: " + dist.toFixed(2) + " km";

  // Simulate ETA (3-10 minutes)
  var eta = Math.floor(Math.random() * 8) + 3;
  etaInfo.textContent = "Driver will arrive in approximately " + eta + " minutes.";
}

function calcDistance(lat1, lng1, lat2, lng2) {
  var R = 6371;
  var dLat = (lat2 - lat1) * Math.PI / 180;
  var dLon = (lng2 - lng1) * Math.PI / 180;
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  return R * c;
}

function trackDriver() {
  if (!currentRideId) return;
  // Call track_driver.php to get updated driver coords
  fetch('track_driver.php?ride_id=' + currentRideId)
    .then(r => r.json())
    .then(d => {
      if (d.error) {
        progressIndicator.textContent = "Error: " + d.error;
      } else {
        // Update marker
        if (driverMarker) {
          driverMarker.setLatLng([d.lat, d.lng]);
        }
        progressIndicator.textContent = "Driver location updated: Lat=" + d.lat.toFixed(4) + ", Lng=" + d.lng.toFixed(4); // Updated progress indicator
      }
    });
}

// View history functionality
viewHistoryBtn.addEventListener('click', function() {
  fetch('fetch_history.php')
    .then(r => r.json())
    .then(d => {
      if (d.error) {
        historyContent.textContent = d.error;
      } else {
        historyContent.innerHTML = "";
        var h = document.createElement('div');
        h.innerHTML = "<p>You have taken " + d.count + " rides so far.</p>";
        var table = document.createElement('table');
        table.style.width = '100%';
        table.border = '1';
        var header = "<tr><th>ID</th><th>Pickup</th><th>Dropoff</th><th>Fare Estimate</th><th>Final Fare</th><th>Status</th><th>Date</th></tr>";
        table.innerHTML = header;
        d.rides.forEach(r => {
          var row = document.createElement('tr');
          row.innerHTML = "<td>" + r.id + "</td><td>" + r.pickup_location + "</td><td>" + r.dropoff_location + "</td><td>$" + parseFloat(r.fare_estimate).toFixed(2) + "</td><td>" + (r.final_fare ? "$" + parseFloat(r.final_fare).toFixed(2) : "") + "</td><td>" + r.status + "</td><td>" + r.requested_at + "</td>";
          table.appendChild(row);
        });
        h.appendChild(table);
        historyContent.appendChild(h);
      }
      historyOverlay.style.display = 'block';
      historyPopup.style.display = 'block';
    });
});

closeHistory.addEventListener('click', function() {
  historyOverlay.style.display = 'none';
  historyPopup.style.display = 'none';
});

closeDriverMsg.addEventListener('click', function() {
  driverMsgOverlay.style.display = 'none';
  driverMsgPopup.style.display = 'none';
});

closeChat.addEventListener('click', function() {
  chatOverlay.style.display = 'none';
  chatPopup.style.display = 'none';
});

function updateMap() {
    fetch('track_driver.php') // Ensure this endpoint returns the correct JSON
        .then(response => response.json())
        .then(data => {
            const lat = data.lat;
            const lng = data.lng;
            const mapUrl = `https://staticmap.openstreetmap.de/staticmap.php?center=${lat},${lng}&zoom=13&size=600x300&markers=red(${lat},${lng})`;
            mapImage.src = mapUrl; // Update the map image
        })
        .catch(error => console.error('Error fetching driver location:', error));
}

// Initialize distance and ETA
let initialDistance = 1.50; // in km
let initialETA = 5; // in minutes

// Function to update distance and ETA
function updateDistanceAndETA() {
    if (initialDistance > 0 && initialETA > 0) {
        initialDistance -= 0.1; // Decrease distance by 0.1 km
        initialETA -= 1; // Decrease ETA by 1 minute
    }

    // Update the displayed values
    document.getElementById('routeInfo').textContent = "Approx Distance: " + initialDistance.toFixed(2) + " km";
    document.getElementById('etaInfo').textContent = "Driver will arrive in approximately " + initialETA + " minutes.";
}

// Call the update function every minute (60000 milliseconds)
setInterval(updateDistanceAndETA, 60000);

// Initial display
updateDistanceAndETA();
</script>
</body>
</html>