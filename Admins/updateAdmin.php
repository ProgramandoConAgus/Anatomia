<?php
include("../con_db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId']; // El id del usuario que se va a actualizar
    $id = $_POST['id']; // Dependiendo del tipo de acción puede ser el id del curso o estado del usuario
    $accion = $_POST['tipoAccion']; // Tipo de acción (1 para actualizar curso, 2 para habilitar/deshabilitar usuario)
    
    // Validar la acción
    if ($accion == 1) {
        // Actualizar el curso del usuario
        $query = "UPDATE usuarios SET idCurso = ? WHERE IdUsuario = ?";
    } else if ($accion == 2) {
        // Habilitar o deshabilitar al usuario
        $query = "UPDATE usuarios SET habilitado = ? WHERE IdUsuario = ?";
    }
    

    $stmt = $conex->prepare($query);
    $stmt->bind_param("ii", $id, $userId); 
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Actualización realizada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conex->error]);
    }

    $stmt->close();
}
?>
