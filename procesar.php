<?php
require('conexion.php');
session_start();

if (isset($_POST["envio"])) {
    $con = conectar_bd();
    $nombre_de_usuario = mysqli_real_escape_string($con, $_POST['nombre']);
    $contrasenia = mysqli_real_escape_string($con, $_POST['pass']);

    // Consulta para verificar el nombre de usuario
    $sql = "SELECT * FROM usuarios WHERE nombre_de_usuario = $nombre_de_usuario";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasenia, $fila['contrasenia'])) {
            // Iniciar sesión
            $_SESSION['nombre_de_usuario'] = $nombre_de_usuario;

            // Si seleccionó "Recordarme", establecer cookie válida por 7 días
            if (isset($_POST['recordar_sesion'])) {
                setcookie('nombre_de_usuario', $nombre_de_usuario, time() + (7 * 24 * 60 * 60), "/"); // 7 días
            }

            // Redirigir al home
            header("Location: home_usuario.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // Usuario no existe
        header("Location: login.php?error=1");
        exit();
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: login.php");
    exit();
}
