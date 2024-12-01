<?php

class Pdf {
    private $catName;
    private $dir;
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function createPdf($idCategoria,$archivo) {
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

            $sqlInsert = 'INSERT INTO pdfs (idCategoria, pdf_path) VALUES (?, ?)';
            if ($stmtInsert = $this->conex->prepare($sqlInsert)) {
                $stmtInsert->bind_param('is', $idCategoria, $pdfPath);
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
}
?>
