<?php
session_start();
// Valida inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // obtengo los datos del post
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $modulo = isset($_POST['modulo']) ? $_POST['modulo'] : null;
    if ($nombre && $descripcion && $modulo ) {
        include("../con_db.php");
        
        
        $sql="SELECT * FROM categoria WHERE nombre=?";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $_SESSION['videos'] ="Ya existe una categoria con ese nombre, no puede volver a cargarse.";
            header("Location: panel-admin.php");
            exit();
        }
        echo $modulo;
        echo $descripcion;  
        echo $nombre;
        $sql = "INSERT INTO categoria (nombre, descripcion, idModulo) VALUES (?, ?, ?)";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $descripcion, $modulo);
        
        if ($stmt->execute()) {
            $_SESSION['videos'] ="Categoria agregada correctamente.";
            header("Location: panel-admin.php");
        } else {
            $_SESSION['videos'] = "Error al guardar en la base de datos: " . $stmt->error;
            header("Location: panel-admin.php");
        }

    }else {
        
        $_SESSION['videos'] =("Por favor, complete todos los campos del formulario o verifica que el archivo se haya subido correctamente.");
        header("Location: panel-admin.php");
    }
} else {
    $_SESSION['videos'] =("Por favor, complete todos los campos del formulario o verifica que el archivo se haya subido correctamente.");
    header("Location: panel-admin.php");
} 
    
?>
