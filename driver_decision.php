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

if (!$ride || $ride['status'] !== 'user_counter_offered') {
    echo json_encode(['error' => 'Ride not in correct state for decision']);
    exit;
}

$proposed = $ride['driver_proposed_fare'];
$offered = $ride['user_offered_fare'];

// Decide
if ($offered >= $proposed * 0.9) {
    // Accept
    $update = $pdo->prepare("UPDATE careem_rides SET status='accepted', final_fare=? WHERE id=?");
    $update->execute([$offered, $ride_id]);
    echo json_encode(['status' => 'accepted']);
} else {
    // Refuse
    $update = $pdo->prepare("UPDATE careem_rides SET status='refused' WHERE id=?");
    $update->execute([$ride_id]);
    echo json_encode(['status' => 'refused']);
}
