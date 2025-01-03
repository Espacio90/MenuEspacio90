<?php
session_start();

// Verificar si la sesión no está activa
if (!isset($_SESSION["username"])) {
    header('Location: Registro.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="icon" href="./img/330841588_980815506215904_8074317732561019356_n.jpg">

    <!-- Agregar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            color: #f5f5f5;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #1c1c1c;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #aaa;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #333;
            border-radius: 8px;
            background: #222;
            color: #fff;
            margin-bottom: 15px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: #ffd700;
        }

        button {
            background: #ffd700;
            color: #121212;
            padding: 10px 15px;
            /* Reducido para hacerlo más angosto */
            border-radius: 30px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
            border: none;
            margin: 0 auto;
            /* Centra el botón */
            width: 25%;
            /* Ajusta el ancho al contenido */
            display: block;
            /* Necesario para que el margin funcione en elementos inline como <button> */
        }

        button:hover {
            background: #ffc107;
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

        .container2 {
            margin-top: 50px;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background: #1c1c1c;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .container2 button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
        }


        .container2 .btn-editar {
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

        .container2 .btn-editar:hover {
            background: #ffd700;
            color: #121212;
            transform: scale(1.1);
        }

        .container2 .btn-eliminar {
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

        .container2 .btn-eliminar:hover {
            background: #ff4d4d;
            color: #121212;
            transform: scale(1.1);
        }

        .swal2-confirm,
        .swal2-cancel {
            width: 100% !important;
            padding: 10px 25px !important;
            /* Aumenta el ancho y el alto de los botones */
            font-size: 16px !important;
            /* Cambia el tamaño de la fuente */
        }

        /* Responsivo */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
            }

            button {
                font-size: 12px;
                padding: 8px 20px;
            }

            input,
            select {
                padding: 10px;
            }
        }
    </style>
</head>

<body>

    <!-- Contenedor de Bootstrap para centrar el formulario -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Agregar Usuario</h1>
        <div class="mb-3">
            <form action="./add_user.php" method="POST">

                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="roles" class="form-label">Rol:</label>
                    <select id="roles" name="roles" class="form-select" required>
                        <option value="" selected disabled>Selecciona un Rol</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Normal">Normal</option>
                    </select>
                </div>

                <button type="submit">Registrar Usuario</button>
                <a href="./inbox.php" class="volver-btn">Volver Al Portal Administrativo</a>
            </form>
        </div>
    </div>
    <div class="container2">
        <h1 class="text-center mb-4">Gestión de Usuarios</h1>

        <!-- Tabla de usuarios -->
        <table class="table table-dark table-striped" id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexión a la base de datos
                $host = "bpavehbnji9bcfyq4vrc-mysql.services.clever-cloud.com";
                $user = "ujgef1glc8f90avd";
                $pass = "y5pE6VRsLUx4H300bEmI";
                $dbname = "bpavehbnji9bcfyq4vrc";
                $port = '3306';

                $conn = new mysqli($host, $user, $pass, $dbname, $port);

                // Verificar conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consultar usuarios
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['roles'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-sm btn-editar' onclick='editUser(" . $row['id'] . ")'>Editar</button> ";
                        echo "<button class='btn btn-sm btn-eliminar' onclick='deleteUser(" . $row['id'] . ")'>Eliminar</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay usuarios registrados.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    </div>

    <!-- Agregar Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.all.min.js"></script>

    <script>
        // Función para mostrar alertas de SweetAlert
        function showAlert(type, title, message) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
            });
        }
        
        // Función para editar un usuario
        function editUser(id, username, roles) {
            // Mostrar el formulario de edición con SweetAlert
            Swal.fire({
                title: 'Editar Usuario',
                html: `
            <input type="text" id="newUsername" class="swal2-input" placeholder="Nuevo nombre de usuario" value="${username}">
            <select id="newRole" class="swal2-input" required>
                <option value="" disabled>Selecciona un rol</option>
                <option value="Administrador" ${roles === 'Administrador' ? 'selected' : ''}>Administrador</option>
                <option value="Normal" ${roles === 'Normal' ? 'selected' : ''}>Normal</option>
            </select>
        `,
                focusConfirm: false,
                preConfirm: () => {
                    const newUsername = document.getElementById('newUsername').value;
                    const newRole = document.getElementById('newRole').value;

                    if (!newUsername || !newRole) {
                        Swal.showValidationMessage('Por favor, complete todos los campos');
                    }
                    return {
                        newUsername,
                        newRole
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const {
                        newUsername,
                        newRole
                    } = result.value;

                    // Enviar los datos actualizados al servidor
                    fetch("agregar_user.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: new URLSearchParams({
                                action: "edit",
                                id: id,
                                username: newUsername,
                                roles: newRole,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            showAlert(data.status === "success" ? 'success' : 'error', data.status === "success" ? 'Éxito' : 'Error', data.message);
                            if (data.status === "success") {
                                location.reload(); // Recarga la página para ver los cambios
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            });
        }

        // Función para eliminar un usuario
        function deleteUser(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Este cambio no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminarlo',
                cancelButtonText: 'Cancelar',
                customClass: {
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("agregar_user.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: new URLSearchParams({
                                action: "delete",
                                id: id,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            showAlert(data.status === "success" ? 'success' : 'error', data.status === "success" ? 'Éxito' : 'Error', data.message);
                            if (data.status === "success") {
                                location.reload(); // Recarga la página para ver los cambios
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            });
        }
    </script>

</body>

</html>