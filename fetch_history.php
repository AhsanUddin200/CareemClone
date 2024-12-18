<?php
session_start();
if(!isset($_SESSION['user_id'])){
    echo json_encode(['error'=>'Not logged in']);
    exit;
}
include 'db.php';

$stmt = $pdo->prepare("SELECT * FROM careem_rides WHERE user_id=? ORDER BY requested_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = count($rides);

echo json_encode([
    'count' => $count,
    'rides' => $rides
]);
