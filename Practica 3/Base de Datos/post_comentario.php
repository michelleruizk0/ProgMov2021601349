<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id_comentario"], $data["comentario"], $data["id_juego"], $data["id_usuario"])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos"]);
    exit;
}

include("conexion.php");

$stmt = $conn->prepare("INSERT INTO COMENTS (id_comentario, comentario, id_juego, id_usuario) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $data["id_comentario"], $data["comentario"], $data["id_juego"], $data["id_usuario"]);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "No se pudo insertar el comentario"]);
}

$stmt->close();
$conn->close();
?>
