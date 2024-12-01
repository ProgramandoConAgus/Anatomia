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

    $pdf = new Pdf($conex);
    $idCategoria = $_POST['categoria'];

    $response = $pdf->createPdf($idCategoria, $_FILES['archivo']);
    echo $response;
} else {
    echo json_encode([
        'status' => 'eror',
        'menssage ' => 'La solicitud no es válida.'
    ]);
}
