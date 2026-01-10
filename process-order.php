<?php
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

$data = json_decode(file_get_contents("php://input"));

if($data) {
    $sql = "INSERT INTO orders (customer_email, total_price) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if($stmt->execute([$data->email, $data->total])) {
        echo json_encode(["success" => true]);
    }
}
?>