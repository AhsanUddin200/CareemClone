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

if ($ride['driver_assigned'] == 1) {
    echo json_encode(['status' => 'already_assigned']);
    exit;
}

// Set driver_assigned=1 and propose a fare (10% higher than estimate)
$driver_proposed_fare = $ride['fare_estimate'] * 1.10;
$update = $pdo->prepare("UPDATE careem_rides SET driver_assigned=1, status='assigned', driver_proposed_fare=? WHERE id=?");
$update->execute([$driver_proposed_fare, $ride_id]);

echo json_encode(['status' => 'assigned', 'driver_proposed_fare' => $driver_proposed_fare]);
