<?php
session_start();

// Verificar si la sesión no está activa
if (!isset($_SESSION["username"])) {
    header('Location: Registro.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'], $_POST['roles'])) {
    $username_valido = true;

    if ($username_valido) {
        $rol = $_POST['roles'];

        // Almacena el rol en la sesión
        $_SESSION['roles'] = $rol;

        // Almacena la contraseña en la sesión
        $_SESSION['password'] = $_POST['password'];

        header('Location: Registro.php');
        exit;
    } else {
        $error_message = "Usuario o contraseña incorrectos";
    }
}

// Verificar el rol del usuario
$esAdministrador = isset($_SESSION["roles"]) && $_SESSION["roles"] === "Administrador";

// Conexión a la base de datos
$host = "bpavehbnji9bcfyq4vrc-mysql.services.clever-cloud.com";
$user = "ujgef1glc8f90avd";
$pass = "y5pE6VRsLUx4H300bEmI";
$dbname = "bpavehbnji9bcfyq4vrc";
$port = '3306';

$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espacio 90</title>
    <link rel="icon" href="./img/330841588_980815506215904_8074317732561019356_n.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* CSS Integrado */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            color: #f5f5f5;
        }

        h1,
        h2,
        h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #ffd700;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .botonuser {
            background: #ffd700;
            color: #fff;
            padding: 10px 25px;
            border-radius: 30px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .botonuser:hover {
            background: #ffd700;
            color: #121212;
            transform: scale(1.1);
        }

        .cerrar-sesion-btn {
            background: #ff0000;
            color: #fff;
            padding: 10px 25px;
            border-radius: 30px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .cerrar-sesion-btn:hover {
            background: #ff0000;
            color: #121212;
            transform: scale(1.1);
        }

        /* Carrusel */
        .carousel-section {
            margin: 20px 0;
        }

        .carousel-inner img {
            width: 100%;
            border-radius: 12px;
            height: 400px;
            object-fit: cover;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            border-radius: 50%;
        }

        .btnAgregar {
            color: #fff;
            padding: 10px 25px;
            border-radius: 30px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btnAgregar:hover {
            color: #121212;
            transform: scale(1.1);
        }

        .btnEditar {
            color: #fff;
            padding: 10px 25px;
            border-radius: 30px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btnEditar:hover {
            color: #121212;
            transform: scale(1.1);
        }

        /* Formularios */
        .form-section {
            background: #1c1c1c;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            margin-top: 20px;
        }

        .form-section h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #ffd700;
        }

        .form-section label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #aaa;
        }

        .form-section input,
        .form-section textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #333;
            border-radius: 8px;
            background: #222;
            color: #fff;
            margin-bottom: 15px;
            outline: none;
        }

        .form-section button {
            background: #1e90ff;
            color: #fff;
            padding: 10px 25px;
            border-radius: 30px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .form-section button:hover {
            background: #1e90ff;
            color: #121212;
            transform: scale(1.1);
        }

        /* Menú */
        .menu-section {
            margin-top: 40px;
            display: center;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background: #1c1c1c;
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }

        .card img {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
            padding: 15px;
        }

        .card-body h5 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #f5f5f5;
        }

        .card-body p {
            color: #ccc;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .card .btn-warning {
            background: #ffd700;
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

        .card .btn-warning:hover {
            background: #ffd700;
            color: #121212;
            transform: scale(1.1);
        }

        .card .btn-danger {
            background: #ff4d4d;
            ;
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

        .card .btn-danger:hover {
            background: #ff4d4d;
            color: #121212;
            transform: scale(1.1);
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .carousel-inner img {
                height: 250px;
            }

            .header-container h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <img src="./img/logo-Photoroomedit.png" />
            <div class="d-flex gap-2"> <!-- Contenedor para alinear los botones más juntos -->
                <?php if ($esAdministrador) : ?>
                    <button class="btn btn-secondary botonuser" onclick="window.location.href='./Agregar_Usuario_pagina.php'">Agregar Usuario</button>
                <?php endif; ?>
                <a href="javascript:void(0);" onclick="cerrarSesion();" class="btn cerrar-sesion-btn">Cerrar Sesión</a>
            </div>
        </div>

        <!-- Botón de agregar usuario -->
        <div class="section-container">
        </div>

        <!-- Sección del Carrusel -->
        <div class="carousel-section">
            <h2 class="text-center mb-4 titulo">Ofertas Del Dia</h2>
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

            <div class="text-center mt-4">
                <button class="btn btn-success btnAgregar me-3" onclick="window.location.href='./carrusel1/index.html'">Agregar Img Carrusel</button>
                <button class="btn btn-warning btnEditar" onclick="window.location.href='./carrusel1/gallery.php'">Editar Img Carrusel</button>
            </div>
        </div>

        <!-- Sección del Formulario -->
        <div class="form-section">
            <h2 class="text-center titulo">Agregar Elemento Al Menú</h2>
            <div></div>
            <form class="ElementMenu" id="addItemForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Nombre Del Trago</label>
                    <input type="text" id="nameInput" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="descriptionInput" class="form-label">ingredientes</label>
                    <textarea id="descriptionInput" name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="imageInput" class="form-label">Imagen</label>
                    <input type="file" id="imageInput" name="image" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary btn-narrow">Guardar</button>
            </form>
        </div>

        <!-- Sección de Items del Menú -->
        <div class="menu-section">
            <h2 class="text-center mb-4 titulo">Tragos Del Menu</h2>
            <div id="menuList" class="row gy-4"></div>
        </div>
    </div>

    <script>
        const addItemForm = document.getElementById('addItemForm');
        const menuList = document.getElementById('menuList');

        // Cargar elementos existentes al cargar la página
        window.onload = () => {
            fetch('get_items.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        data.items.forEach(item => renderMenuItem(item));
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        });
                    }
                });
        };

        // Agregar ítem
        addItemForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('save_item.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        renderMenuItem(data.item);
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Ítem agregado correctamente.',
                        });
                        addItemForm.reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        });
                    }
                });
        });

        // Renderizar ítem
        function renderMenuItem(item) {
            const colDiv = document.createElement('div');
            colDiv.classList.add('col-md-4');

            const itemDiv = document.createElement('div');
            itemDiv.classList.add('card', 'h-100');
            itemDiv.dataset.id = item.id;

            const img = document.createElement('img');
            img.src = item.image;
            img.alt = 'Menu Item';
            img.classList.add('card-img-top');
            img.style.height = '200px';
            img.style.objectFit = 'cover';

            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            const name = document.createElement('h5');
            name.classList.add('card-title');
            name.textContent = item.name;

            const description = document.createElement('p');
            description.classList.add('card-text');
            description.textContent = item.description;

            const btnGroup = document.createElement('div');
            btnGroup.classList.add('mt-3', 'text-center');

            const editButton = document.createElement('button');
            editButton.textContent = 'Editar';
            editButton.classList.add('btn', 'btn-warning', 'me-2');
            editButton.addEventListener('click', () => editItem(item, name, description));

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Eliminar';
            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.addEventListener('click', () => deleteItem(item.id, colDiv));

            btnGroup.appendChild(editButton);
            btnGroup.appendChild(deleteButton);

            cardBody.appendChild(name);
            cardBody.appendChild(description);
            cardBody.appendChild(btnGroup);

            itemDiv.appendChild(img);
            itemDiv.appendChild(cardBody);
            colDiv.appendChild(itemDiv);

            menuList.appendChild(colDiv);
        }

        // Editar ítem
        function editItem(item, nameElement, descElement) {
            Swal.fire({
                title: 'Editar elemento',
                html: `<input id="swal-input1" class="swal2-input" placeholder="Nuevo nombre" value="${item.name}">
                 <textarea id="swal-input2" class="swal2-textarea" placeholder="Nueva descripción">${item.description}</textarea>`,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
            }).then(result => {
                if (result.isConfirmed) {
                    const newName = document.getElementById('swal-input1').value;
                    const newDescription = document.getElementById('swal-input2').value;

                    if (newName && newDescription) {
                        fetch('update_item.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    id: item.id,
                                    name: newName,
                                    description: newDescription,
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Éxito!',
                                        text: 'Ítem actualizado correctamente.',
                                    });
                                    nameElement.textContent = newName;
                                    descElement.textContent = newDescription;
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message,
                                    });
                                }
                            });
                    }
                }
            });
        }

        // Eliminar ítem
        function deleteItem(id, colDiv) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'No podrás revertir esta acción.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
            }).then(result => {
                if (result.isConfirmed) {
                    fetch('delete_item.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                id
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Eliminado!',
                                    text: 'El ítem ha sido eliminado.',
                                });
                                colDiv.remove();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message,
                                });
                            }
                        });
                }
            });
        }

        function mostrarImagenAmpliada(carouselId) {
            const imagenActual = document.querySelector(`#carousel-example-captions${carouselId} .carousel-item.active img`);
            if (imagenActual) {
                document.getElementById(`imagenAmpliadaSrc${carouselId}`).src = imagenActual.src;
                document.getElementById(`imagenAmpliada${carouselId}`).style.display = 'flex';
            }
        }

        function cerrarImagenAmpliada(carouselId) {
            document.getElementById(`imagenAmpliada${carouselId}`).style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            setInterval(() => {
                document.querySelector("#carousel-example-captions1 .carousel-control-next").click();
            }, 5000);
        });

        function cerrarSesion() {
            window.location.href = "./cerrar_session.php";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>