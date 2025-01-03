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

    $stmt = $pdo->query("SELECT * FROM menu_items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'items' => $items]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>