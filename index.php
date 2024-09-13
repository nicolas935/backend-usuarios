<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "tu_contraseña_root";
$dbname = "users_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si hay datos enviados desde un formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Encriptar la contraseña

    $sql = "INSERT INTO users (nombre, apellido, password, telefono) VALUES ('$nombre', '$apellido', '$password', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario registrado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<form method="post" action="index.php">
  Nombre: <input type="text" name="nombre"><br>
  Apellido: <input type="text" name="apellido"><br>
  Teléfono: <input type="text" name="telefono"><br>
  Contraseña: <input type="password" name="password"><br>
  <input type="submit" value="Registrar">
</form>
