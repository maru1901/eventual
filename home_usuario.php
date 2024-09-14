<?php
session_start();

// Verifica si la sesión está iniciada, si no redirige al login
if (!isset($_SESSION['nombre_de_usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_de_usuario']); ?></h1>
<a href="logout.php">Cerrar Sesión</a>
