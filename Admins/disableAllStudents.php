<?php
session_start();
include('../con_db.php');
include('../eventsClass.php');

$events = new Events($conex);

if ($_SERVER['REQUEST_METHOD'] === 'POST' 
    && isset($_SESSION['loggedin']) 
    && isset($_SESSION['idUsuario']) 
    && $_SESSION['loggedin'] === true 
    && $_SESSION['IdTipoUsuario'] == 2) {
    
    $date = $_POST['fecha-evento'] ?? null;
    $action = $_POST['action'];
    
    if ( $action == 'create'){
        if (!$date) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'La fecha es requerida']);
            exit;
        }
    
        $result = $events->disableAllStudentForEvents($date);
        
        header('Content-Type: application/json');
        echo $result; 
        exit;
    }else if ($action == 'delete') {
        $result = $events->deletevent();
        
        header('Content-Type: application/json');
        echo $result;
    }else{
        $result = $events->getDateEvent();
        
        header('Content-Type: application/json');
        echo $result;
    }
    
} else {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Usuario no autorizado']);
    exit;
}
?>