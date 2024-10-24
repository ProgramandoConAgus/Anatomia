<?php
session_start();
// Valida inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // obtengo los datos del post
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
    $modulo = isset($_POST['modulo']) ? $_POST['modulo'] : null;
    $video = isset($_FILES['video']) ? $_FILES['video'] : null;
    
    // valido que los campos esten completos
    if ($titulo && $categoria && $video && $video['error'] === UPLOAD_ERR_OK) { 
        include("../con_db.php");
        
        // directorio donde se guardaran los videos
        $directorioSubida = 'uploads/videos/';
        
        // Obtener el nombre del archivo y crear la ruta
        $nombreArchivo = basename($video['name']);
        $rutaArchivo = $directorioSubida . $nombreArchivo;

        $sql="SELECT * FROM videos WHERE video_path=?";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $rutaArchivo);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $_SESSION['videos'] ="Este video ya esta cargado, no puede volver a cargarse.";
            header("Location: panel-admin.php");
            exit();
        }
        
         
        // Mover el archivo a la ubicación deseada
        if (move_uploaded_file($video['tmp_name'], "../".$rutaArchivo)) {
            // Guardar información en la base de datos
            $sql = "INSERT INTO videos (titulo, idCategoria, video_path) VALUES (?, ?, ?)";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("sis", $titulo, $categoria, $rutaArchivo);
            
            if ($stmt->execute()) {
                $_SESSION['videos'] ="Video cargado y guardado correctamente.";
                header("Location: panel-admin.php");
            } else {
                $_SESSION['videos'] = "Error al guardar en la base de datos: " . $stmt->error;
                header("Location: panel-admin.php");
            }
        } else {
            $_SESSION['videos'] =("Error al mover el archivo a la carpeta de destino.");
            header("Location: panel-admin.php");
        }
    } else {
        $_SESSION['videos'] =("Por favor, complete todos los campos del formulario o verifica que el archivo se haya subido correctamente.");
        header("Location: panel-admin.php");
    }
}
?>
