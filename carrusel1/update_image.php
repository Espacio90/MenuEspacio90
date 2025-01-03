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

if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    $imagen = mysqli_real_escape_string($conn, $imagen);

    // Actualiza la información de la imagen
    $sql = "UPDATE imagenes SET nombre='$nombre', imagen='$imagen', tipo_imagen='$tipo' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: gallery.php");
        exit();
    } else {
        echo "Error al editar la imagen: " . $conn->error;
    }
}

$conn->close();
?>