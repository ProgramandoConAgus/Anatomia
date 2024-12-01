<?php
session_start();
include('../con_db.php');
include('../pdfClass.php');
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_SESSION['loggedin'])
    && isset($_SESSION['idUsuario'])
    && $_SESSION['loggedin'] === true
    && $_SESSION['IdTipoUsuario'] == 2
) {
    if (!isset($_POST['categoria']) || empty($_POST['categoria']) || !isset($_FILES['archivo']) || $_FILES['archivo']['error'] != UPLOAD_ERR_OK ) {
        echo json_encode([
            'status' => 'error',
            'message' => 'La categoría y el archivo son requeridos'
        ]);
        exit; 
    }

    $pdf = new Pdf($conex);
    $idCategoria = $_POST['categoria'];

    $response = $pdf->createPdf($idCategoria, $_FILES['archivo']);
    echo $response;
} else {
    echo json_encode([
        'status' => 'eror',
        'message ' => 'La solicitud no es válida.'
    ]);
}
