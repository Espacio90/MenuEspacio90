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

  $conn = new mysqli($host, $user, $pass, $dbname, $port);

  // Verifica si la conexión es exitosa
  if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
  }

  $username = $_POST["username"];
  $password = $_POST["password"];
  $roles = $_POST["roles"];

  $sql = "INSERT INTO users (username, password, roles) VALUES ('$username', '$password', '$roles')";

  if ($conn->query($sql) === TRUE) {
    echo '<script>
    Swal.fire({
        icon: "success",
        title: "El Usuario Se Ha Registrado Correctamente.",
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
        text: "Error Al Registrar El Usuario.",
        showConfirmButton: false,
        timer: 3000 // Duración del mensaje en milisegundos (3 segundos en este caso)
    }).then(() => {
        window.location.href = "Agregar_Usuario_Pagina.php";
    });
</script>';
    exit;
  }
  $conn->close();
  ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>