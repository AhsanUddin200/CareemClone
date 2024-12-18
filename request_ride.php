<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    echo json_encode(['error'=>'Not logged in']);
    exit;
}

include 'db.php';

// In a real scenario, you'd get these from POST/JSON:
$pickup = $_POST['pickup'] ?? '';
$dropoff = $_POST['dropoff'] ?? '';

// Hard-coded coords (you would get from map clicks or geocoding)
$pickup_lat = 24.8607; 
$pickup_lng = 67.0011;
$dropoff_lat = 24.8707; 
$dropoff_lng = 67.0111;

if(!$pickup || !$dropoff) {
    echo json_encode(['error'=>'Missing locations']);
    exit;
}

// Calculate a fake distance
function calcDistance($lat1,$lng1,$lat2,$lng2) {
    $earthRadius=6371;
    $dLat=deg2rad($lat2-$lat1);
    $dLon=deg2rad($lng2-$lng1);
    $a=sin($dLat/2)*sin($dLat/2)+sin($dLon/2)*sin($dLon/2)*cos(deg2rad($lat1))*cos(deg2rad($lat2));
    $c=2*atan2(sqrt($a), sqrt(1-$a));
    return $earthRadius*$c;
}

$distance = calcDistance($pickup_lat,$pickup_lng,$dropoff_lat,$dropoff_lng);
$fare_estimate = $distance * 1.5;

$stmt = $pdo->prepare("INSERT INTO careem_rides (user_id,pickup_location,dropoff_location,fare_estimate,status,driver_assigned,driver_lat,driver_lng) VALUES (?,?,?,?,?,?,?,?)");
$stmt->execute([$_SESSION['user_id'],$pickup,$dropoff,$fare_estimate,'driver_pricing',0,$pickup_lat,$pickup_lng]);
$ride_id = $pdo->lastInsertId();

echo json_encode(['ride_id'=>$ride_id,'fare_estimate'=>$fare_estimate]);
