<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "bpavehbnji9bcfyq4vrc-mysql.services.clever-cloud.com";
$user = "ujgef1glc8f90avd";
$pass = "y5pE6VRsLUx4H300bEmI";
$dbname = "bpavehbnji9bcfyq4vrc";
$port = "3306";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid() . '-' . basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = $uploadFile;

            $name = $_POST['name'];
            $description = $_POST['description'];

            $stmt = $pdo->prepare("INSERT INTO menu_items (name, description, image) VALUES (:name, :description, :image)");
            $stmt->execute(['name' => $name, 'description' => $description, 'image' => $imagePath]);

            $itemId = $pdo->lastInsertId();
            echo json_encode(['status' => 'success', 'item' => [
                'id' => $itemId,
                'name' => $name,
                'description' => $description,
                'image' => $imagePath
            ]]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No image file uploaded or upload error.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>