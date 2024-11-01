<?php
include("../con_db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId']; // El id del usuario que se va a actualizar
    $id = $_POST['id']; // Dependiendo del tipo de acción puede ser el id del curso o estado del usuario
    $accion = $_POST['tipoAccion']; // Tipo de acción (1 para actualizar curso, 2 para habilitar/deshabilitar usuario)
    
    // Validar la acción
    if ($accion == 1) {
        $ids = explode(",", $id);
        $query = "SELECT idCurso FROM usuarioscursos WHERE idUsuario=?";
        $stmt = $conex->prepare($query);
        $stmt->bind_param("i", $userId); 
        $stmt->execute();
        $result = $stmt->get_result(); // Obtén el resultado
        
        // Almacena los cursos encontrados en un array
        $cursosEncontrados = [];
        while ($row = $result->fetch_assoc()) {
            $cursosEncontrados[] = $row['idCurso']; // Almacena los idCurso encontrados
        }
        
        // Recorre los ids y verifica si se encontraron
        foreach ($ids as $cursoId) {
            // Verifica si el curso no está en los cursos encontrados
            if (!in_array($cursoId, $cursosEncontrados)) {
                // Si el curso no está, se agrega a la base de datos
                $insertQuery = "INSERT INTO usuarioscursos (idUsuario, idCurso) VALUES (?, ?)";
                $insertStmt = $conex->prepare($insertQuery);
                $insertStmt->bind_param("ii", $userId, $cursoId); 
                if ( $insertStmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Actualización realizada correctamente']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => $conex->error]);
                }
                $insertStmt->close(); 
            } 
        }
        
        // Revisa y elimina los cursos que no están en $ids
        foreach ($cursosEncontrados as $cursoId) {
            if (!in_array($cursoId, $ids)) {
                // Realiza la consulta para eliminar el curso
                $deleteQuery = "DELETE FROM usuarioscursos WHERE idCurso=? AND idUsuario=?";
                $deleteStmt = $conex->prepare($deleteQuery);
                $deleteStmt->bind_param("ii", $cursoId, $userId); // Asegúrate de que ambos son enteros
                
                if ($deleteStmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Actualización realizada correctamente']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => $conex->error]);
                }
                $deleteStmt->close(); 
            }
        }
        
        $stmt->close();
        


    } else if ($accion == 2) {
        // Habilitar o deshabilitar al usuario
        $query = "UPDATE usuarios SET habilitado = ? WHERE IdUsuario = ?";
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

}
?>
