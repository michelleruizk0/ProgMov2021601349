<?php
header('Content-Type: application/json');
require 'conexion.php';

$datos = json_decode(file_get_contents("php://input"));

// Validar que todos los campos necesarios estén presentes
if (
    isset($datos->nombre) &&
    isset($datos->plataforma) &&
    isset($datos->genero) &&
    isset($datos->calificacion) &&
    isset($datos->estado) &&
    isset($datos->opinion) &&
    isset($datos->imagen)
) {
    // Generar UUID para el juego
    $id_juego = uniqid();

    try {
        $stmt = $pdo->prepare("INSERT INTO JUEGOS 
            (id_juego, nombre, plataforma, genero, calificacion, estado, opinion, imagen, eliminado, fecha_mod) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, NOW())");

        $stmt->execute([
            $id_juego,
            $datos->nombre,
            $datos->plataforma,
            $datos->genero,
            $datos->calificacion,
            $datos->estado,
            $datos->opinion,
            $datos->imagen
        ]);

        echo json_encode(["mensaje" => "Juego registrado correctamente"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error al registrar juego: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos o no válidos"]);
}
?>
