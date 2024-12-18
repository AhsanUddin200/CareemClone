<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    echo json_encode(['error'=>'Not logged in']);
    exit;
}

include 'db.php';

$ride_id = $_POST['ride_id'] ?? 0;
$final_fare = $_POST['final_fare'] ?? 0;

if(!$ride_id || !$final_fare) {
    echo json_encode(['error'=>'Missing ride_id or final_fare']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM careem_rides WHERE id=? AND user_id=?");
$stmt->execute([$ride_id,$_SESSION['user_id']]);
$ride = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$ride || $ride['status']!=='driver_pricing') {
    echo json_encode(['error'=>'Ride not in correct state or not found']);
    exit;
}

// Update ride to assigned
$update=$pdo->prepare("UPDATE careem_rides SET status='assigned',driver_assigned=1, final_fare=? WHERE id=?");
$update->execute([$final_fare,$ride_id]);

echo json_encode(['success'=>true,'final_fare'=>$final_fare]);
