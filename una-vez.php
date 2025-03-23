<?php/*
include('con_db.php');
// ID del usuario al que se le quiere actualizar la contraseña
$idUsuario = 120; // Cambia este valor al ID del usuario específico
$nuevaPassword = "12345678"; // Coloca aquí la contraseña en texto plano

// Hashear la nueva contraseña
$hashedPassword = password_hash($nuevaPassword, PASSWORD_BCRYPT);

// Preparar y ejecutar la consulta para actualizar la contraseña del usuario específico
$sql = "UPDATE usuarios SET password = ? WHERE IdUsuario = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("si", $hashedPassword, $idUsuario);

if ($stmt->execute()) {
    echo "Contraseña actualizada exitosamente.";
} else {
    echo "Error al actualizar la contraseña: " . $stmt->error;
}

// Cerrar la declaración
$stmt->close();*/
?>
