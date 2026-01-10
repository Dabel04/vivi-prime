<?php
require_once '../db_connect.php';
$db = new Database();
$conn = $db->connect();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $size = $_POST['size'];
        $color = $_POST['color'];

        // 1. INSERT PRODUCT (Get ID first)
        // We initialize with a placeholder or empty string for the main image
        $sql = "INSERT INTO products (name, category, description, price, stock, size, color, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, '')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $category, $description, $price, $stock, $size, $color]);
        $product_id = $conn->lastInsertId();

        // 2. PROCESS IMAGES (Loop through all uploads)
        $target_dir = "../img/";
        $uploaded_images = [];

        if (isset($_FILES['images'])) {
            $total_files = count($_FILES['images']['name']);
            
            for ($i = 0; $i < $total_files; $i++) {
                $file_name = time() . "_" . $i . "_" . basename($_FILES["images"]["name"][$i]);
                $target_file = $target_dir . $file_name;
                $db_path = "img/" . $file_name; // Path stored in DB

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file)) {
                    // Save to Gallery Vault
                    $imgStmt = $conn->prepare("INSERT INTO product_images (product_id, image_url) VALUES (?, ?)");
                    $imgStmt->execute([$product_id, $db_path]);
                    $uploaded_images[] = $db_path;
                }
            }
        }

        // 3. UPDATE MAIN IMAGE
        // We set the first uploaded image as the "Cover Image" for the shop grid
        if (!empty($uploaded_images)) {
            $updateStmt = $conn->prepare("UPDATE products SET image_url = ? WHERE id = ?");
            $updateStmt->execute([$uploaded_images[0], $product_id]);
        }

        echo json_encode(["success" => true]);

    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
?>