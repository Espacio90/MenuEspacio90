<?php
// Conexión a la base de datos
$host = "bpavehbnji9bcfyq4vrc-mysql.services.clever-cloud.com";
$user = "ujgef1glc8f90avd";
$pass = "y5pE6VRsLUx4H300bEmI";
$dbname = "bpavehbnji9bcfyq4vrc";
$port = '3306';

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Lógica para editar un usuario
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $roles = $_POST['roles'];

    $sql = "UPDATE users SET username = ?, roles = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $roles, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario editado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al editar el usuario.']);
    }

    $stmt->close();
    exit();
}

// Lógica para eliminar un usuario
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario eliminado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el usuario.']);
    }

    $stmt->close();
    exit();
}

$conn->close();
