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

if (isset($_POST['subir'])) {
    $nombre = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    $imagen = mysqli_real_escape_string($conn, $imagen);

    $sql = "INSERT INTO imagenes (nombre, imagen, tipo_imagen) VALUES ('$nombre', '$imagen', '$tipo')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.html?exito=1");
        exit();
    } else {
        echo "Error al subir la imagen: " . $conn->error;
    }
}

$conn->close();
?>