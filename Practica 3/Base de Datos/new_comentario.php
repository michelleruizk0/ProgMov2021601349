<?php
header("Content-Type: application/json");
require 'conexion.php'; // Este archivo debe definir $pdo (PDO)

// Obtener el cuerpo del request
$datos = json_decode(file_get_contents("php://input"));

// Validación básica
if (
    isset($datos->comentario) &&
    isset($datos->id_juego) &&
    isset($datos->id_usuario)
) {
    // Generar un UUID para el comentario
    function generarUUID() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    $id_comentario = generarUUID();

    try {
        $sql = "INSERT INTO COMENTS (id_comentario, comentario, id_juego, id_usuario)
                VALUES (:id_comentario, :comentario, :id_juego, :id_usuario)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_comentario' => $id_comentario,
            ':comentario' => $datos->comentario,
            ':id_juego'    => $datos->id_juego,
            ':id_usuario'  => $datos->id_usuario
        ]);

        echo json_encode(["mensaje" => "Comentario guardado correctamente"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error al guardar el comentario: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos o inválidos"]);
}
?>
