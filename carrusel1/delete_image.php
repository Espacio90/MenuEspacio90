<?php
$host = "bpavehbnji9bcfyq4vrc-mysql.services.clever-cloud.com";
$user = "ujgef1glc8f90avd";
$pass = "y5pE6VRsLUx4H300bEmI";
$dbname = "bpavehbnji9bcfyq4vrc";
$port = '3306';

$conn = new mysqli($host, $user, $pass, $dbname, $port);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "DELETE FROM imagenes WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: gallery.php?exito=1");
    exit();
} else {
    echo "Error al eliminar la imagen: " . $conn->error;
}

$conn->close();
?>