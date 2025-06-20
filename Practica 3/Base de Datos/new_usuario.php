<?php
header("Content-Type: application/json");

// Mostrar errores (quitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'conexion.php';

// Obtener el cuerpo del request como JSON
$usuario = json_decode(file_get_contents("php://input"));

// Validar que se hayan enviado los datos requeridos
if (
    !$usuario ||
    !isset($usuario->nom_usuario) ||
    !isset($usuario->correo) ||
    !isset($usuario->contrasena)
) {
    http_response_code(400);
    echo json_encode(["error" => "Datos incompletos o inválidos"]);
    exit();
}

// Generar UUID
function generarUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

$id_usuario = generarUUID();

try {
    $stmt = $pdo->prepare("INSERT INTO USUARIO (id_usuario, nom_usuario, correo, contrasena) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $id_usuario,
        $usuario->nom_usuario,
        $usuario->correo,
        $usuario->contrasena
    ]);

    echo json_encode([
        "mensaje" => "Usuario insertado correctamente",
        "id_usuario" => $id_usuario
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al insertar el usuario", "detalle" => $e->getMessage()]);
}
?>
