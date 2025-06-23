<?php
header("Content-Type: application/json");
include("conexion.php");

$query = "SELECT * FROM USUARIO";
$resultado = mysqli_query($conexion, $query);

$usuarios = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    $usuarios[] = $row;
}

echo json_encode($usuarios);
?>