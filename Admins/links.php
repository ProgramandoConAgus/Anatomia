<?php
include('../con_db.php');
header("Content-Type: application/json");

// Leer el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

// Validar los datos recibidos
if (!isset($data['tipoLink'], $data['cursoId'], $data['nuevoLink'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

// Asignar datos a variables
$tipoLink = $data['tipoLink']; // 'wpp' o 'dri'
$cursoId = $data['cursoId'];
$nuevoLink = $data['nuevoLink'];

// Determinar columna a actualizar
$columna = ($tipoLink === 'wpp') ? 'linkWhatsapp' : (($tipoLink === 'dri') ? 'linkDrive' : null);

if (!$columna) {
    echo json_encode(['success' => false, 'message' => 'Tipo de link inválido.']);
    exit;
}

// Actualizar la base de datos
$sql = "UPDATE cursos SET $columna = ? WHERE IdCurso = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("si", $nuevoLink, $cursoId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Link actualizado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el link.']);
}

$stmt->close();
