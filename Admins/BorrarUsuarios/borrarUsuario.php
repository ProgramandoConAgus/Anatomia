<?php
if (isset($_POST['userId'])) {
    $idUsuario = $_POST['userId'];
    include("../../con_db.php");

    //Crea la SQLQuery que eliminara el foreign key de la tabla: usuarioscursos
    $sql2 = "DELETE FROM usuarioscursos WHERE idUsuario = ?";
    $stmt2 = $conex->prepare($sql2);
    $stmt2->bind_param('i', $idUsuario);
    $stmt2->execute();


    $stmt2->close();

    //Crea la SQLQuery que eliminara el Usuario con la Id especificida, de la tabla: usuarios
    $sql = "DELETE FROM usuarios WHERE IdUsuario = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param('i', $idUsuario);
    $stmt->execute();

    //Verifica que el usuario se haya eliminado sino devuelve que hubo un error
    if ($stmt->affected_rows > 0){
    }
    else {
        echo json_encode(['success' => false, 'message' => 'Hubo un error']);
    }

    $stmt->close();
    
    echo json_encode(['success' => true, 'message' => 'Se elimino el usuario correctamente']);
    
}else{
    echo json_encode(['success' => false, 'message' => 'El usuario no existe']);
}
?>