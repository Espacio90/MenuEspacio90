<?php
session_start();

// Verificar si la sesión no está activa
if (!isset($_SESSION["username"])) {
    header('Location: Registro.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Imagen</title>
    <link rel="icon" href="../img/330841588_980815506215904_8074317732561019356_n.jpg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            color: #f5f5f5;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #central {
            max-width: 600px;
            width: 100%;
            padding: 30px;
            background: rgba(28, 28, 28, 0.8);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        #subirimagenesV2 {
            color: #f5f5f5;
        }

        .titulo {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #ffd700;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        #imagen-label {
            font-weight: bold;
            color: #aaa;
            margin-bottom: 10px;
            display: block;
        }

        #imagen {
            width: 100%;
            padding: 12px;
            border: 1px solid #333;
            border-radius: 8px;
            background: #222;
            color: #fff;
            margin-bottom: 20px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        #imagen:focus {
            border-color: #ffd700;
        }

        button[type="submit"] {
            background-color: #ffd700;
            color: #121212;
            padding: 10px 15px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            margin-top: 10px;
            width: 25%;
            display: block;
            margin: 0 auto;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #ffc107;
            color: #121212;
            transform: scale(1.1);
        }

        .volver-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #ffd700;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .volver-btn:hover {
            color: #ffc107;
        }

        #mensaje-exito {
            color: green;
            margin-top: 10px;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .titulo {
                font-size: 1.5rem;
            }

            button[type="submit"] {
                font-size: 12px;
                padding: 8px 20px;
                width: auto;
            }

            input,
            select {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="contenedor">
        <div id="central">
            <div id="subirimagenesV2">
                <img src="../img/logo-Photoroomedit.png" />
                <div class="titulo letraSerif">Reemplazar por Nueva Imagen</div>
                <?php
                // Verifica si se ha pasado el parámetro 'id' en la URL
                if (!isset($_GET['id'])) {
                    echo "ID de imagen no proporcionado.";
                    exit();
                }

                $id = $_GET['id'];

                // Conexión a la base de datos
                $host = "bpavehbnji9bcfyq4vrc-mysql.services.clever-cloud.com";
                $user = "ujgef1glc8f90avd";
                $pass = "y5pE6VRsLUx4H300bEmI";
                $dbname = "bpavehbnji9bcfyq4vrc";
                $port = '3306';

                $conn = new mysqli($host, $user, $pass, $dbname, $port);

                // Verifica la conexión a la base de datos
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Recupera la información de la imagen
                $sql = "SELECT nombre, tipo_imagen FROM imagenes WHERE id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nombre = $row['nombre'];
                    $tipoImagen = $row['tipo_imagen'];
                } else {
                    echo "Imagen no encontrada.";
                    exit();
                }

                // Procesa el formulario de edición cuando se envía
                if (isset($_POST['editar'])) {
                    $nombreNuevo = $_FILES['imagen']['name'];
                    $tipoNuevo = $_FILES['imagen']['type'];
                    $imagenNuevo = file_get_contents($_FILES['imagen']['tmp_name']);
                    $imagenNuevo = mysqli_real_escape_string($conn, $imagenNuevo);

                    // Actualiza la información de la imagen en la base de datos
                    $sqlUpdate = "UPDATE imagenes SET nombre='$nombreNuevo', imagen='$imagenNuevo', tipo_imagen='$tipoNuevo' WHERE id=$id";

                    if ($conn->query($sqlUpdate) === TRUE) {
                        header("Location: gallery.php");
                        exit();
                    } else {
                        echo "Error al editar la imagen: " . $conn->error;
                    }
                }
                ?>

                <!-- Formulario de edición -->
                <form action="" method="post" enctype="multipart/form-data">
                    <label id="imagen-label" for="imagen">Selecciona una nueva imagen:</label>
                    <input type="file" name="imagen" id="imagen" required>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="editar">Editar Imagen</button>
                </form>


                <!-- Botón para volver a gallery.php -->
                <a href="gallery.php" class="volver-btn">Volver A La Galería</a>

                <!-- Puedes mostrar la imagen actual aquí si es necesario -->
            </div>
        </div>
    </div>
</body>

</html>