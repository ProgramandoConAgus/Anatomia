<?php

class Pdf {
    private $dir='./materiales/';
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex; 
    }

    public function createPdf($idCategoria, $titulo, $archivo) {
        $response = [];
        $pdfName = basename($archivo['name']);

        if (strtolower($pdfName,PATHINFO_EXTENSION)!='pdf'){//por ahora solo se admiten pdfs
            $response['status'] = 'error';
            $response['message'] = 'Solo se permiten archivos con extensión pdf.';
            return json_encode($response);
        }
        
        if (!isset($archivo['name'], $archivo['tmp_name']) || !is_uploaded_file($archivo['tmp_name'])) {
            $response['status'] = 'error';
            $response['message'] = 'Archivo no válido o no se recibió correctamente.';
            return json_encode($response);
        }
        
        
        $destino = $this->dir . $pdfName;

        if (move_uploaded_file($archivo['tmp_name'], $destino)) {
            $pdfPath = $destino; 
          
            $sql = 'INSERT INTO pdfs (idCategoria, pdfPath, titulo) VALUES (?, ?, ?)';
            if ($stmt = $this->conex->prepare($sql)) {
                $stmt->bind_param('iss', $idCategoria, $pdfPath, $titulo);

                if ($stmt->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = 'PDF guardado correctamente.';
                } else {
                    unlink($destino); // Si ocurre un error, se borra el archivo del servidor
                    $response['status'] = 'error';
                    $response['message'] = 'Error al guardar el PDF en la base de datos: ' . $stmt->error;
                }

                $stmt->close();
            } else {
                unlink($destino);
                $response['status'] = 'error';
                $response['message'] = 'Error al preparar la consulta SQL: ' . $this->conex->error;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al mover el archivo al directorio destino.';
        }

        return json_encode($response);
    }
}

?>
