<?php

class Pdf {
    private $catName;
    private $dir;
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function createPdf($idCategoria,$titulo,$archivo) {
        $response = [];

        $pdfName = basename($archivo['name']); // Obtenemos el nombre del archivo
        $extension = pathinfo($pdfName, PATHINFO_EXTENSION);

        if (strtolower($extension) != 'pdf') { // Validamos la extensión, por el momento solo PDF
            $response['status'] = 'error';
            $response['message'] = 'Solo se permiten archivos con extensión PDF.';
            return $response;
        }

        if (!isset($archivo['name'], $archivo['tmp_name']) || !is_uploaded_file($archivo['tmp_name'])) { // Validamos si el archivo fue cargado desde un formulario
            $response['status'] = 'error';
            $response['message'] = 'Archivo no válido';
            return $response;
        }

        try {
            $this->conex->begin_transaction(); // Manejamos como una transacción

            $sqlQueryCategoria = 'SELECT nombre FROM categoria WHERE idCategoria = ?';
            if ($stmtSelect = $this->conex->prepare($sqlQueryCategoria)) {
                $stmtSelect->bind_param('i', $idCategoria);
                $stmtSelect->execute();
                $result = $stmtSelect->get_result();

                if ($result->num_rows === 0) { // Validamos la categoría
                    throw new Exception('No se encontró la categoría especificada.');
                }

                $this->catName = $result->fetch_assoc()['nombre']; // Seteamos la propiedad categoría
                $stmtSelect->close();
            } else {
                throw new Exception('Error al preparar la consulta SELECT: ' . $this->conex->error);
            }

            $this->dir = '../materiales/' . $this->catName . '/'; // Construimos la ruta completa
            if (!is_dir($this->dir)) {
                if (!mkdir($this->dir, 0777, true)) {
                    throw new Exception('No se pudo crear el directorio: ' . $this->dir);
                }
            }

            $pdfPath = $this->dir . $pdfName;

            $sqlInsert = 'INSERT INTO pdfs (idCategoria, pdf_path, titulo) VALUES (?, ?,?)';
            if ($stmtInsert = $this->conex->prepare($sqlInsert)) {
                $stmtInsert->bind_param('iss', $idCategoria, $pdfPath,$titulo);
                if (!$stmtInsert->execute()) {
                    throw new Exception('Error al guardar el PDF en la base de datos: ' . $stmtInsert->error);
                }
                $stmtInsert->close();
            } else {

                throw new Exception('Error al persistir los archivos: ' . $this->conex->error);
            }
            
            if (file_exists($pdfPath)){
                throw new Exception('El archivo seleccionado ya existe');
            }

            if (!move_uploaded_file($archivo['tmp_name'], $pdfPath)) {
                throw new Exception('Error al mover el archivo al directorio destino.');
            }
           
            $this->conex->commit();

            $response['status'] = 'success';
            $response['message'] = 'PDF guardado correctamente.';
            $response['categoria'] = $this->catName;
        } catch (Exception $e) {
            $this->conex->rollback();

            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }

        return json_encode($response);
    }

    public function getPdfListTree(){
        $response = [];
        $sqlGetPdfs = "SELECT * FROM pdfs";



        try{
            
            $result = $this->conex->query($sqlGetPdfs );
        
        }catch(Exception $e){
            $response['status'] = 'error';
            $response['message'] = 'Error al realizar la consulta: '.$e->getMessage();
            return json_encode($response);
        }

        $response['status'] = 'success';
        $response['message'] = '';
        $response['count'] = $result-> num_rows;
        
        if ($result-> num_rows > 0){
            $data = [];
            while($row = $result->fetch_assoc()){
              array_push($data ,$row);
            }
            $response['data'] = $data;

        }else{
            
            $response['message'] = 'No se encontraror resultados';
        }
        return json_encode($response);
    }

    public function deletePdf($data) {
        $response = [
            'status' => '',
            'message' => '',
            'errors' => [],
            'deleted' => []
        ];
    
        if (empty($data)) {
            $response['status'] = 'error';
            $response['message'] = 'No se proporcionaron datos para eliminar.';
            return json_encode($response);
        }
    
        try {
            $this->conex->begin_transaction(); // Inicia la transacción
    
            $filePathsToDelete = []; // Para almacenar las rutas de los archivos a eliminar
            $fileNames = []; // Para almacenar los nombres de archivos y reportar eliminaciones
    
            foreach ($data as $folder) {
                if (!isset($folder['name']) || !isset($folder['files'])) {
                    $response['errors'][] = "Datos incompletos para la carpeta.";
                    continue;
                }
    
                $folderName = $folder['name'];
                $dirPath = "../materiales/$folderName/";
    
                foreach ($folder['files'] as $file) {
                    if (!isset($file['name']) || $file['type'] !== 'file') {
                        $response['errors'][] = "Datos incompletos para el archivo en carpeta '$folderName'.";
                        continue;
                    }
    
                    $fileName = $file['name'];
                    $filePath = $dirPath . $fileName;
    
                    // Añadir la ruta del archivo a eliminar
                    $filePathsToDelete[] = $filePath;
                    $fileNames[] = $fileName;
                }
            }
    
            if (empty($filePathsToDelete)) {
                $response['status'] = 'error';
                $response['message'] = 'No se encontraron archivos para eliminar.';
                return json_encode($response);
            }
    
            // Eliminar los archivos de la base
            $placeholders = implode(',', array_fill(0, count($filePathsToDelete), '?')); // Crear los placeholders para la consulta
            $sqlDelete = "DELETE FROM pdfs WHERE pdf_path IN ($placeholders)";
            $stmt = $this->conex->prepare($sqlDelete);
            if ($stmt) {
                $stmt->bind_param(str_repeat('s', count($filePathsToDelete)), ...$filePathsToDelete); // Unbind de todas las rutas
                if ($stmt->execute() && $stmt->affected_rows > 0) {
                    // Intentar eliminar los archivos del sistema de archivos
                    foreach ($filePathsToDelete as $index => $filePath) {
                        if (file_exists($filePath)) {
                            if (unlink($filePath)) {
                                $response['deleted'][] = "Archivo '{$fileNames[$index]}' eliminado correctamente.";
                            } else {
                                $response['errors'][] = "No se pudo eliminar el archivo '{$fileNames[$index]}'.";
                            }
                        } else {
                            $response['errors'][] = "El archivo '{$fileNames[$index]}' no existe.";
                        }
                    }
                } else {
                    $response['errors'][] = "No se pudo eliminar los archivos de la base de datos.";
                }
                $stmt->close();
            } else {
                $response['errors'][] = "Error al preparar la consulta DELETE: " . $this->conex->error;
            }
    
            if (empty($response['errors'])) {
                $this->conex->commit(); // Confirma la transacción si no hay errores
                $response['status'] = 'success';
                $response['message'] = 'Todos los archivos fueron eliminados correctamente.';
            } else {
                $this->conex->rollback(); // Revierte la transacción si hubo errores
                $response['status'] = 'partial';
                $response['message'] = 'Algunos archivos no pudieron eliminarse.';
            }
        } catch (Exception $e) {
            $this->conex->rollback(); // Revierte la transacción en caso de error
            $response['status'] = 'error';
            $response['message'] = 'Error al eliminar los archivos: ' . $e->getMessage();
        }
    
        return json_encode($response);
    }
    

}
?>
