<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../AchsLogo.png" />
    <title>Inicio sesión</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./csslogin/mainbootstrap.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    $host = "bpavehbnji9bcfyq4vrc-mysql.services.clever-cloud.com";
    $user = "ujgef1glc8f90avd";
    $pass = "y5pE6VRsLUx4H300bEmI";
    $dbname = "bpavehbnji9bcfyq4vrc";
    $port = '3306';

    $conn = mysqli_connect($host, $user, $pass, $dbname, $port);

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Recupera los valores del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];
    $roles = $_POST["roles"];

    // Realiza la consulta a la base de datos
    $sql = "SELECT * FROM users WHERE username='$username' AND roles='$roles'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        session_start();

        // Realiza la verificación de la contraseña (mejora la seguridad utilizando funciones hash)
        if ($password === $fila["password"]) {
            // Establece las variables de sesión
            $_SESSION["username"] = $username;
            $_SESSION["roles"] = $roles;

            // Redirige al usuario a la página de inicio después de iniciar sesión
            echo '<script>
    Swal.fire({
        icon: "success",
        title: "Credenciales Correctas",
        showConfirmButton: false,
        timer: 3000 // Duración del mensaje en milisegundos (3 segundos en este caso)
    }).then(() => {
        window.location.href = "inbox.php"; // Redirige al usuario después de 3 segundos
    });
</script>';
            exit;
        } else {
            echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "La Contraseña No Es Válida.",
        showConfirmButton: false,
        timer: 3000 // Duración del mensaje en milisegundos (3 segundos en este caso)
    }).then(() => {
        window.location.href = "Registro.php";
    });
</script>';
            exit();
        }
    } else {
        // Si no se encuentra ningún usuario con esas credenciales, muestra un mensaje de error con Bootstrap
        echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "No Se Encontró Ningún Usuario Con Esas Credenciales.",
        showConfirmButton: false,
        timer: 3000 // Duración del mensaje en milisegundos (3 segundos en este caso)
    }).then(() => {
        window.location.href = "Registro.php";
    });
</script>';
                exit;
    }

    mysqli_close($conn);
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>