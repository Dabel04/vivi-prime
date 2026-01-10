<?php
require_once '../db_connect.php';
$db = new Database();
$conn = $db->connect();

header('Content-Type: application/json');

// Get raw POST data (JSON)
$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    try {
        // Optional: You could fetch the image path first to delete the file from the server
        // but for now, let's just clear the database record.
        
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt->execute([$data->id])) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Deletion failed"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "No ID provided"]);
}
?>