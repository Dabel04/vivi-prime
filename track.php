<?php
require_once 'db_connect.php'; // Ensure this points to your DB class
session_start();

$db = new Database();
$conn = $db->connect();

$data = json_decode(file_get_contents("php://input"));
$action = $data->action ?? '';
$session_id = session_id(); // Use PHP's built-in session ID

if ($action === 'init') {
    // 1. Log a new session if it doesn't exist
    $stmt = $conn->prepare("SELECT id FROM sessions WHERE session_id = ?");
    $stmt->execute([$session_id]);
    
    if ($stmt->rowCount() === 0) {
        $stmt = $conn->prepare("INSERT INTO sessions (session_id) VALUES (?)");
        $stmt->execute([$session_id]);
    }
} 
elseif ($action === 'add_to_cart') {
    // 2. Mark session as "Has Cart"
    $stmt = $conn->prepare("UPDATE sessions SET has_cart = 1 WHERE session_id = ?");
    $stmt->execute([$session_id]);
} 
elseif ($action === 'checkout_start') {
    // 3. Mark session as "Has Checkout"
    $stmt = $conn->prepare("UPDATE sessions SET has_checkout = 1 WHERE session_id = ?");
    $stmt->execute([$session_id]);
}

echo json_encode(['status' => 'tracked']);
?>