
<?php
session_start();
include 'db.php';

$ride_id = isset($_GET['ride_id'])?(int)$_GET['ride_id']:0;
if($ride_id<=0){
    echo json_encode(['error'=>'Invalid ride_id']);
    exit;
}

// Fetch current ride
$stmt = $pdo->prepare("SELECT * FROM careem_rides WHERE id=? AND user_id=?");
$stmt->execute([$ride_id,$_SESSION['user_id']]);
$ride = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$ride || $ride['driver_assigned'] != 1 || $ride['status']!='assigned'){
    echo json_encode(['error'=>'Ride not in trackable state']);
    exit;
}

// Simulate driver movement by nudging lat/lng
$lat = $ride['driver_lat'] + (rand(-5,5)/10000);
$lng = $ride['driver_lng'] + (rand(-5,5)/10000);

$up = $pdo->prepare("UPDATE careem_rides SET driver_lat=?, driver_lng=? WHERE id=?");
$up->execute([$lat, $lng, $ride_id]);

echo json_encode([
    'lat'=>$lat,
    'lng'=>$lng,
    'status'=>'assigned'
]);
