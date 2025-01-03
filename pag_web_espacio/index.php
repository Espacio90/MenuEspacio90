<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/330841588_980815506215904_8074317732561019356_n.jpg">
    <title>Espacio 90</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 32px;
            color: #ffd700;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .titulo {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #ffd700;
        }

        .titulo2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #ffd700;
            margin-top: 20px;
        }

        .container {
            max-width: 100%;
            padding: 15px;
        }

        .botonuser {
            background: #ffd700;
            color: #121212;
            padding: 10px 20px;
            border-radius: 30px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .botonuser:hover {
            background: #ffc107;
            color: #121212;
            transform: scale(1.1);
        }

        .carousel-inner img {
            display: block;
            width: 100%;
            /* Escala la imagen al 100% del ancho del contenedor */
            height: auto;
            /* Mantiene la relación de aspecto original */
            object-fit: contain;
            /* Asegura que la imagen se ajuste sin recortarse */
        }

        #menuList {
            margin-top: 30px;
            margin-bottom: 40px;
        }

        .list-group-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
            background-color: #1e1e1e;
            border: 1px solid #343a40;
            border-radius: 8px;
            transition: all 0.3s ease;
            flex-wrap: nowrap;
        }

        .list-group-item:hover {
            background-color: #2c2c2c;
        }

        .list-group-item img {
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #ffc107;
            width: 80px;
            height: 80px;
            flex-shrink: 0;
        }

        .list-group-item .flex-grow-1 {
            padding-left: 10px;
            flex-grow: 1;
            overflow: visible;
        }

        .list-group-item h5 {
            font-size: 18px;
            font-weight: 600;
            color: #ffd700;
            margin-bottom: 5px;
        }

        .list-group-item p {
            font-size: 14px;
            color: #adb5bd;
            margin-bottom: 0;
            word-wrap: break-word;
            white-space: normal;
        }

        /* Carrusel de imágenes */
        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .carousel-item img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: contain;
            max-width: 100%;
        }

        /* Carrusel tamaño ajustable en pantallas grandes y pequeñas */
        @media (max-width: 767px) {
            .carousel-item img {
                width: 100%;
                height: auto;
            }

            h1 {
                font-size: 24px;
            }

            .titulo {
                font-size: 20px;
            }

            .titulo2 {
                font-size: 20px;
            }

            .botonuser {
                font-size: 12px;
                padding: 8px 15px;
            }

            .list-group-item {
                gap: 10px;
                padding: 10px;
            }

            .list-group-item img {
                width: 60px;
                height: 60px;
            }

            .list-group-item h5 {
                font-size: 16px;
            }

            .list-group-item p {
                font-size: 12px;
            }
        }

        /* Ajustes para pantallas más grandes (PC) */
        @media (min-width: 768px) {
            #menuList {
                max-width: 75%;
                margin: 0 auto;
                margin-top: 20px;
                /* Centra la lista en pantallas grandes */
            }

            h1 {
                font-size: 40px;
            }

            .titulo {
                font-size: 26px;
            }

            .titulo2 {
                font-size: 26px;
            }

            .botonuser {
                font-size: 16px;
                padding: 12px 25px;
            }

            .carousel-inner {
                width: 70%;
                margin: 0 auto;
            }

            .list-group-item {
                gap: 20px;
                padding: 20px;
            }

            .list-group-item img {
                width: 100px;
                height: 100px;
            }

            .list-group-item h5 {
                font-size: 20px;
            }

            .list-group-item p {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <img src="./img/logo-Photoroomedit.png" />
            <button class="btn botonuser" id="loginButton">Login</button>
        </div>
        <div class="carousel-section">
            <h2 class="text-center mb-4 titulo">Ofertas</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="carousel-example-captions1" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
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
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-example-captions1" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-example-captions1" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <h2 class="text-center mb-4 titulo2">menú</h2>
        </div>
        <div id="menuList" class="list-group">
            <!-- Menu items will be fetched from the database and displayed here -->
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Fetch menu items
            fetch('fetch_items.php')
                .then(response => response.json())
                .then(data => {
                    const menuList = document.getElementById('menuList');

                    data.forEach(item => {
                        const itemContainer = document.createElement('div');
                        itemContainer.classList.add('list-group-item', 'd-flex', 'align-items-start', 'mb-3');

                        const img = document.createElement('img');
                        img.src = item.image;
                        img.alt = item.name;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.classList.add('me-3', 'img-thumbnail');

                        const descriptionContainer = document.createElement('div');
                        descriptionContainer.classList.add('flex-grow-1');

                        const nameHeading = document.createElement('h5');
                        nameHeading.textContent = item.name;
                        nameHeading.classList.add('mb-1');

                        const descriptionText = document.createElement('p');
                        descriptionText.textContent = item.description;
                        descriptionText.classList.add('mb-1');

                        descriptionContainer.appendChild(nameHeading);
                        descriptionContainer.appendChild(descriptionText);

                        itemContainer.appendChild(img);
                        itemContainer.appendChild(descriptionContainer);

                        menuList.appendChild(itemContainer);
                    });
                });

            // Login button click
            const loginButton = document.getElementById('loginButton');
            loginButton.addEventListener('click', () => {
                window.location.href = 'Registro.php'; // Redirect to login page
            });
        });
    </script>
</body>

</html>