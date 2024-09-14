<?php 
require("header.php");
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
    $consulta = "INSERT INTO usuarios (nombre, telefono, fecha_nacimiento, correo_electronico, nombre_de_usuario, contrasenia) 
                 VALUES ('$nombre', '$telefono', '$fecha_nacimiento', '$correo_electronico', '$nombre_de_usuario', '$hashed_password')";
    
    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($con, $consulta)) {
        // Redirigir al login tras el registro exitoso
        echo "<script>
                alert('Registro exitoso. Ahora puedes iniciar sesión.');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($con);
    }
    
    mysqli_close($con);
}

?>

<div id="modal_form">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form id="form_usuario" method="POST" action="registro.php">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="correo_electronico">Correo Electrónico:</label>
                        <input type="email" id="correo_electronico" name="correo_electronico" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre_de_usuario">Nombre de Usuario:</label>
                        <input type="text" id="nombre_de_usuario" name="nombre_de_usuario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="contrasenia">Contraseña:</label>
                        <input type="password" id="contrasenia" name="contrasenia" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrarse</button>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Vaciar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require("footer.php"); ?>

