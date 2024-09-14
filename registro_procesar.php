<?php 
require("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = conectar_bd();
    
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo_electronico = $_POST['correo_electronico'];
    $nombre_de_usuario = $_POST['nombre_de_usuario'];
    $contrasenia = $_POST['contrasenia'];
    
    // Hashear la contraseña antes de guardarla
    $hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT);
    
    // Consulta para insertar los datos del nuevo usuario
    $consulta = "INSERT INTO usuarios (nombre, telefono, fech_nacimiento, correo_electronico, nombre_de_usuario, contrasenia) 
                 VALUES ('$nombre', '$telefono', '$fecha_nacimiento', '$correo_electronico', '$nombre_de_usuario', '$hashed_password')";
    
    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($con, $consulta)) {
        // Redirigir al login tras el registro exitoso
        header("Location: login.php?registro_exitoso=1");
        exit();
    } else {
        // En caso de error, redirigir de nuevo al formulario de registro con un mensaje de error
        header("Location: registro.php?error=1");
        exit();
    }
    
    mysqli_close($con);
}
?>
