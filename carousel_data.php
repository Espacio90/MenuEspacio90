<?php
$host = "bpavehbnji9bcfyq4vrc-mysql.services.clever-cloud.com";
$user = "ujgef1glc8f90avd";
$pass = "y5pE6VRsLUx4H300bEmI";
$dbname = "bpavehbnji9bcfyq4vrc";
$port = '3306';

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT * FROM imagenes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $active = true;
    while ($row = $result->fetch_assoc()) {
        $imagenData = base64_encode($row['imagen']);
        $imagenSrc = 'data:' . $row['tipo_imagen'] . ';base64,' . $imagenData;

        echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">
            <img class="d-block w-100" src="' . $imagenSrc . '" alt="' . $row['nombre'] . '">
          </div>';
        $active = false;
    }
} else {
    echo '<p class="text-center">No hay imágenes en la base de datos.</p>';
}

$conn->close();
?>