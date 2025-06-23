<?php
header("Content-Type: application/json");
include("conexion.php");

$query = "SELECT * FROM JUEGOS";
$resultado = mysqli_query($conexion, $query);

$juegos = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    $juegos[] = $row;
}

echo json_encode($juegos);
?>