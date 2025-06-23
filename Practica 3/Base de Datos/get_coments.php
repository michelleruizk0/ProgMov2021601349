<?php
header("Content-Type: application/json");
include("conexion.php");

$query = "SELECT * FROM COMENTS";
$resultado = mysqli_query($conexion, $query);

$comentarios = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    $comentarios[] = $row;
}

echo json_encode($comentarios);
?>