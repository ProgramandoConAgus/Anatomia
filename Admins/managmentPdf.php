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
    if (!isset($_POST['action'])){
        echo json_encode([
            'status' => 'error',
            'message' => 'No se encontró la acción'
        ]);
        exit; 
    }
    $action = $_POST['action'];
    $pdf = new Pdf($conex);
    switch($action){
        case 'getCategorias':
            $response = $pdf->getCategorias();
            echo json_encode($response);
            break;
        case 1:
            if (!isset($_POST['categoria']) || empty($_POST['categoria']) ) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'La categoría es requerida'
                ]);
                exit; 
            }
            if (!isset($_FILES['archivo']) ) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'El archivo es requerido'
                ]);
                exit; 
            }
            /*if($_FILES['archivo']['error'] != UPLOAD_ERR_OK  ){
                echo json_encode([
                    'status' => 'error',
                    'message' => $_FILES['archivo']['error'],
                ]);
                exit; 
            }*/
            
            
            $idCategoria = $_POST['categoria'];
            $titulo = !isset( $_POST['titulo'] ) ? '' :  $_POST['titulo'];
            $response = $pdf->createPdf($idCategoria, $titulo, $_FILES['archivo']);
            echo $response;
            break;
        case 2:
            $response = $pdf->getPdfListTree();
            echo $response;
            break;
        case 3:
            $data = isset($_POST['data']) ? json_decode($_POST['data'], true) : null;
            if (json_last_error() !== JSON_ERROR_NONE || empty($data)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Datos inválidos o faltantes.'
                ]);
                exit;
            }
            $response = $pdf->deletePdf($data);
            echo $response;
            break;
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'La solicitud no es válida.'
    ]);
}
?>
