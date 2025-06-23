<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id_usuario"], $data["nom_usuario"], $data["correo"], $data["contrasena"])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos"]);
    exit;
}

include("conexion.php");

$stmt = $conn->prepare("INSERT INTO USUARIO (id_usuario, nom_usuario, correo, contrasena) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $data["id_usuario"], $data["nom_usuario"], $data["correo"], $data["contrasena"]);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "No se pudo insertar"]);
}

$stmt->close();
$conn->close();
?>
