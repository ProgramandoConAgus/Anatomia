<?php
session_start();
// Valida inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // obtengo los datos del post
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $curso = isset($_POST['curso']) ? $_POST['curso'] : null;
    $video = isset($_FILES['video']) ? $_FILES['video'] : null;
    print_r($titulo . "<br>");
    print_r($curso . "<br>");
    print_r($video);
    
    
    // valido que los campos esten completos
    if ($titulo && $curso && $video && $video['error'] === UPLOAD_ERR_OK) { 
        include("../con_db.php");
        
        // directorio donde se guardaran los videos
        $directorioSubida = '../uploads/videos/';
        
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
        if (move_uploaded_file($video['tmp_name'], $rutaArchivo)) {
            // Guardar información en la base de datos
            $sql = "INSERT INTO videos (titulo, idCurso, video_path) VALUES (?, ?, ?)";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("sis", $titulo, $curso, $rutaArchivo);
            
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
