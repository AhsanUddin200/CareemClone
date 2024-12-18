<?php
include 'db.php';
header('Content-Type: application/json');

$ride_id = isset($_GET['ride_id']) ? (int)$_GET['ride_id'] : 0;

if ($ride_id <= 0) {
    echo json_encode(['error' => 'Invalid ride_id']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM careem_rides WHERE id=?");
$stmt->execute([$ride_id]);
$ride = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ride) {
    echo json_encode(['error' => 'Ride not found']);
    exit;
}

if ($ride['status'] !== 'accepted') {
    echo json_encode(['status' => $ride['status'], 'message' => 'Tracking only if accepted']);
    exit;
}

// Simulate movement
$lat = $ride['driver_lat'];
$lng = $ride['driver_lng'];
$lat += (rand(-10,10)/10000);
$lng += (rand(-10,10)/10000);
$update = $pdo->prepare("UPDATE careem_rides SET driver_lat=?, driver_lng=? WHERE id=?");
$update->execute([$lat, $lng, $ride_id]);

echo json_encode([
    'status' => 'accepted',
    'driver_lat' => $lat,
    'driver_lng' => $lng
]);
