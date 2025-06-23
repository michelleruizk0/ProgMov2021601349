<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id_juego"])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos"]);
    exit;
}

include("conexion.php");

$stmt = $conn->prepare("INSERT INTO JUEGOS (id_juego, nombre, plataforma, genero, calificacion, estado, opinion, imagen, eliminado, fecha_mod) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssssssssss",
    $data["id_juego"],
    $data["nombre"],
    $data["plataforma"],
    $data["genero"],
    $data["calificacion"],
    $data["estado"],
    $data["opinion"],
    $data["imagen"],
    $data["eliminado"],
    $data["fecha_mod"]
);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "No se pudo insertar"]);
}

$stmt->close();
$conn->close();
?>
