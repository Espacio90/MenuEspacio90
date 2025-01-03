<?php
session_start();

// Simulación de datos de usuario registrados (puedes usar una base de datos en producción).
$usuariosRegistrados = [
    'usuario1' => 'password1',
    'usuario2' => 'password2'
];

// Verificar si el formulario fue enviado.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar si las credenciales son correctas.
    if (isset($usuariosRegistrados[$username]) && $usuariosRegistrados[$username] === $password) {
        // Credenciales correctas, guardar sesión y redirigir.
        $_SESSION['usuario'] = $username;
        header('Location: Agregar_Usuario_Pagina.php');
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="icon" href="./img/330841588_980815506215904_8074317732561019356_n.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            color: #f5f5f5;
        }

        .logo-center {
            display: block;
            margin: 0 auto;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #ffd700;
            margin-bottom: 20px;
            margin-top: 10px;
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

        .button1 {
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

        .button1:hover {
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

         /* Responsivo */
         @media (max-width: 768px) {
            body {
                padding: 0 10px;
            }

            .container {
                max-width: 95%;
                margin: 30px auto;
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            input,
            select {
                font-size: 0.85rem;
                padding: 10px;
            }

            .button1 {
                font-size: 0.9rem;
                padding: 10px;
                max-width: 100%;
            }

            .volver-btn {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <img src="./img/logo-Photoroomedit.png" class="logo-center" />
        <h1 class="text-center mb-4">Inicio de sesión</h1>
        <form action="login.php" method="POST" onsubmit="return validarInicioSesion();">
            <div class="mb-3">
                <label for="usernameInput" class="form-label">Username</label>
                <input type="text" id="usernameInput" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" id="passwordInput" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="roles">Rol:</label>
                <select id="roles" name="roles" class="form-control">
                    <option value="" selected disabled>Selecciona un Rol</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Normal">Normal</option>
                </select>
            </div>
            <button type="submit" class="button1">Login</button>
            <a href="./index.html" class="volver-btn">Volver Al Portal</a>
        </form>
    </div>

    <script>
    </script>
</body>

</html>