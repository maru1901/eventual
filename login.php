<?php
require_once("header.php");
session_start();

// Verifica si ya hay una sesión activa
if (isset($_SESSION['nombre_de_usuario'])) {
    header("Location: home_usuario.php");
    exit();
}

// Si no hay sesión pero existe la cookie, restablecemos la sesión
if (!isset($_SESSION['nombre_de_usuario']) && isset($_COOKIE['nombre_de_usuario'])) {
    $_SESSION['nombre_de_usuario'] = $_COOKIE['nombre_de_usuario'];
    header("Location: home_usuario.php");
    exit();
}
?>

<body>
<div class="cajita">
    <h4>Inicio de Sesión</h4>

    <!-- Mostrar error si existe -->
    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <p style="color: red;">Usuario o contraseña incorrectos.</p>
    <?php endif; ?>

    <form method="post" action="procesar.php">
        <label for="nombre">Ingrese su Nombre de Usuario</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="pass">Ingrese su Contraseña</label>
        <input type="password" id="pass" name="pass" required><br><br>

        <label>
            <input type="checkbox" name="recordar_sesion" value="1"> Recordarme
        </label><br><br>

        <input class="boton" type="submit" value="Ingresar" name="envio">
        <br><br>

        <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </form>
</div>

<?php require("footer.php"); ?>
