<?php
require('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = conectar_bd();

    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($con, $_POST['telefono']);
    $fecha_nacimiento = mysqli_real_escape_string($con, $_POST['fecha_nacimiento']);
    $correo_electronico = mysqli_real_escape_string($con, $_POST['correo_electronico']);
    $nombre_de_usuario = mysqli_real_escape_string($con, $_POST['nombre_de_usuario']);
    $contrasenia = mysqli_real_escape_string($con, $_POST['contrasenia']);
    $hashed_pass = password_hash($contrasenia, PASSWORD_BCRYPT);

    // Verificar si el nombre de usuario ya existe
    $sql_verificar = "SELECT * FROM usuarios WHERE nombre_de_usuario = ?";
    $stmt_verificar = $con->prepare($sql_verificar);
    $stmt_verificar->bind_param("s", $nombre_de_usuario);
    $stmt_verificar->execute();
    $resultado = $stmt_verificar->get_result();

    if ($resultado->num_rows > 0) {
        echo "El nombre de usuario ya existe. <br><a href='registro.php'>Volver al registro</a>";
    } else {
        // Insertar usuario
        $sql = "INSERT INTO usuarios (nombre, telefono, fecha_nacimiento, correo_electronico, nombre_de_usuario, contrasenia) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssss", $nombre, $telefono, $fecha_nacimiento, $correo_electronico, $nombre_de_usuario, $hashed_pass);

        if ($stmt->execute()) {
            echo "Usuario registrado con éxito. <br><a href='login.php'>Iniciar Sesión</a>";
        } else {
            echo "Error en el registro: " . $con->error;
        }
    }

    $stmt->close();
    $con->close();
}
?>
