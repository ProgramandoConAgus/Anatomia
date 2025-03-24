<?php
    $host = 'localhost'; // Cambia esto si tu host es diferente
    $db = 'anatomia';
    $user = 'root';
    $password = '';
    
    $conex = new mysqli($host, $user, $password, $db);
    
    if ($conex->connect_error) {
        die("La conexión a la base de datos falló: " . $conex->connect_error);
    }
    
    
?>