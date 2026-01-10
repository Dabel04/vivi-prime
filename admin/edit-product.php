<?php
require_once '../db_connect.php';
$db = new Database();
$conn = $db->connect();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['edit_id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $size = $_POST['size'];
        $color = $_POST['color'];

        // 1. UPDATE BASIC INFO
        $sql = "UPDATE products SET name=?, category=?, description=?, price=?, stock=?, size=?, color=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $category, $description, $price, $stock, $size, $color, $id]);

        // 2. HANDLE NEW IMAGES (If any were uploaded)
        if (!empty($_FILES['images']['name'][0])) {
            $target_dir = "../img/";
            $total_files = count($_FILES['images']['name']);
            $uploaded_images = [];

            for ($i = 0; $i < $total_files; $i++) {
                $file_name = time() . "_" . $i . "_" . basename($_FILES["images"]["name"][$i]);
                $target_file = $target_dir . $file_name;
                $db_path = "img/" . $file_name;

                if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file)) {
                    // A. Add to Vault
                    $imgStmt = $conn->prepare("INSERT INTO product_images (product_id, image_url) VALUES (?, ?)");
                    $imgStmt->execute([$id, $db_path]);
                    $uploaded_images[] = $db_path;
                }
            }

            // B. Update Main Cover Image (Set to the first new image uploaded)
            if (!empty($uploaded_images)) {
                $updateCover = $conn->prepare("UPDATE products SET image_url = ? WHERE id = ?");
                $updateCover->execute([$uploaded_images[0], $id]);
            }
        }

        echo json_encode(["success" => true]);
        
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
?>