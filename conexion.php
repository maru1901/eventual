<?php
function conectar_bd() {
    $servidor = "localhost";
    $bd = "eventual";
    $usuario = "root";
    $pass = "";

    $conn = mysqli_connect($servidor, $usuario, $pass, $bd);

    if (!$conn) {
        die("Error de conexión " . mysqli_connect_error());
    }
    return $conn;
}
?>
