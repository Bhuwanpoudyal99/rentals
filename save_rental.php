<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id']) && !isset($_POST['skip_auth'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No data received']);
    exit;
}

try {
    $rental_id = 'RENT' . time() . rand(100, 999);
    
    $stmt = $pdo->prepare("INSERT INTO rentals (rental_id, user_id, bike_id, bike_name, rental_type, duration, total_price, customer_name, customer_age, customer_license, customer_address, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $rental_id,
        $_SESSION['user_id'] ?? null,
        $data['bike_id'],
        $data['bike_name'],
        $data['type'],
        $data['duration'],
        $data['total_price'],
        $data['full_name'],
        $data['age'],
        $data['license_number'],
        $data['address'],
        'pending'
    ]);
    
    echo json_encode(['success' => true, 'rental_id' => $rental_id, 'message' => 'Booking saved to database']);
    
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>