

<?php
class Pdf {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function getCategorias() {
        $query = "SELECT * FROM categoria_pdfs";
        $result = mysqli_query($this->conex, $query);
        $categorias = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return [
            'status' => 'success',
            'data' => $categorias
        ];
    }

    public function createPdf($idCategoria, $titulo, $archivo) {
    $maxSize = 500 * 1024 * 1024; // 50 MB
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return json_encode(['status' => 'error', 'message' => 'Error al subir el archivo.', 'errorCode' => $archivo['error']]);
    }
    if ($archivo['size'] > $maxSize) {
        return json_encode(['status' => 'error', 'message' => 'El archivo excede el tamaño permitido de 500MB.']);
    }

    $nombreArchivo = $archivo['name'];
    $rutaDestino = 'uploads/pdfs/' . $nombreArchivo;
    $rutaDestinoCompleta = $_SERVER['DOCUMENT_ROOT'] . '/' . $rutaDestino;
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestinoCompleta)) {
        $query = "INSERT INTO pdfs (idCategoria, titulo, pdf_path) VALUES ('$idCategoria', '$titulo', '$rutaDestino')";
        if (mysqli_query($this->conex, $query)) {
            return json_encode(['status' => 'success', 'message' => 'PDF subido y registrado con éxito.']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Error al registrar el PDF en la base de datos.']);
        }
    } else {
        return json_encode(['status' => 'error', 'message' => 'Error al mover el archivo al destino.', 'tmp_name' => $archivo['tmp_name'], 'rutaDestino' => $rutaDestino, 'rutaActual'=> __DIR__]);
    }
}


    public function getPdfListTree() {
        $query = "SELECT pdfs.*, categoria_pdfs.nombre AS categoria FROM pdfs INNER JOIN categoria_pdfs ON pdfs.idCategoria = categoria_pdfs.id";
        $result = mysqli_query($this->conex, $query);
        $pdfs = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return json_encode(['status' => 'success', 'data' => $pdfs]);
    }

    public function deletePdf($data) {
        foreach ($data as $categoria) {
            foreach ($categoria['files'] as $file) {
                $query = "DELETE FROM pdfs WHERE pdf_path = '../uploads/" . $file['name'] . "' AND idCategoria = (SELECT id FROM categoria_pdfs WHERE nombre = '" . $categoria['name'] . "')";
                mysqli_query($this->conex, $query);
                unlink('../uploads/' . $file['name']); // Elimina el archivo del servidor
            }
        }
        return json_encode(['status' => 'success', 'message' => 'PDFs eliminados con éxito.']);
    }

    
}
?>
