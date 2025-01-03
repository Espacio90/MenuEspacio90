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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/330841588_980815506215904_8074317732561019356_n.jpg">
    <title>Galería de Imágenes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            color: #f5f5f5;
            display: flex;
            justify-content: center;
            /* Centra horizontalmente */
            align-items: center;
            /* Centra verticalmente */
            height: 100vh;
            /* Asegura que el body ocupe toda la altura de la pantalla */
            flex-direction: column;
            /* Alinea los elementos en una columna */
        }

        .titulo {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #ffd700;
            margin-bottom: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            background-color: #1c1c1c;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin-top: 20px;
            /* Reduce este valor para acercarlo más arriba */
        }

        .carousel-inner {
            text-align: center;
            padding: 0;
            /* Eliminamos el padding para hacer que el contenedor ocupe menos espacio */
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 5px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            color: #fff;
        }

        .carousel-item img {
            max-width: 100%;
            height: auto;
            border: 1px solid #333;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
        }

        .carousel {
            width: 100%;
            /* El carrusel sigue ocupando el 100% del ancho disponible */
            max-width: 800px;
            /* Reducimos el ancho máximo del carrusel */
            margin: 25px;
            /* Centramos el carrusel y reducimos el margen superior e inferior */
            position: center;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            /* Ajusta la separación entre los botones */
            justify-content: center;
            /* Opcional: centra los botones */
        }

        .btn-editar {
            background: #ffd700;
            color: #fff;
            border: none;
            padding: 8px 16px;
            /* Ajusta el tamaño del botón */
            font-size: 14px;
            border-radius: 20px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
            /* Elimina subrayado por defecto de los enlaces */
            display: inline-block;
            /* Hace que el enlace se comporte como un bloque */
            transition: background 0.3s ease, transform 0.3s ease;
            cursor: pointer;
            /* Cambia el cursor cuando pasa por encima */
        }

        .btn-editar:hover {
            background: #ffd700;
            color: #121212;
            transform: scale(1.1);
        }

        .btn-editar:focus {
            outline: none;
            /* Elimina el borde de enfoque al hacer clic */
        }

        .delete-button {
            background: #ff4d4d;
            color: #fff;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 20px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .delete-button:hover {
            background: #ff4d4d;
            color: #121212;
            transform: scale(1.1);
        }

        .volver-btn {
            background-color: #ffc107;
            color: #fff;
            display: block;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 30px;
            text-align: center;
            transition: background 0.3s ease, color 0.3s ease;
            width: 25%;
            margin: 0px auto;
            /* Márgenes pequeños para mantenerlo cerca del carrusel */
        }

        .volver-btn:hover {
            background-color: #ffc107;
            color: #121212;
            transform: scale(1.1);
        }

        @media (max-width: 767px) {
            .titulo {
                font-size: 1.5rem;
            }

            .carousel-caption {
                position: static;
            }

            .volver-btn {
                margin-top: 20px;
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <div id="carouselExampleIndicators" class="carousel slide text-center" data-ride="carousel">
        <div class="titulo letraSerif">Galeria Carrusel Gerencia</div>
        <div class="carousel-inner">
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

            $sql = "SELECT id, nombre, tipo_imagen FROM imagenes";
            $result = $conn->query($sql);

            $firstItem = true;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="carousel-item ' . (($firstItem) ? 'active' : '') . '">';
                    echo '<img class="d-block w-100" src="show_image.php?id=' . $row['id'] . '" alt="' . $row['nombre'] . '">';
                    echo '<div class="carousel-caption d-none d-md-block">';
                    echo '<div class="btn-container">';
                    echo '<button class="delete-button" onclick="eliminarImagen(' . $row['id'] . ')">Eliminar</button>';
                    echo '<a href="edit_image.php?id=' . $row['id'] . '" class="btn-editar">Editar</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    $firstItem = false;
                }
            } else {
                echo "No hay imágenes en la base de datos.";
            }

            $conn->close();
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <a href="../inbox.php" class="volver-btn">Volver A La Galería</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#carouselExampleIndicators').carousel('next');
            }, 3000);
        })

        function eliminarImagen(id) {
            if (confirm("¿Estás seguro de que deseas eliminar esta imagen?")) {
                var form = document.createElement('form');
                form.method = 'post';
                form.action = 'delete_image.php';

                var inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'id';
                inputId.value = id;

                form.appendChild(inputId);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>

</html>