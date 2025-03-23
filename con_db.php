<?php
    $host = 'localhost'; // Cambia esto si tu host es diferente
    $db = 'u981249563_preparandoanat';
    $user = 'u981249563_candela';
    $password = 'Pr3p4r4nd04n4t0';
    
    $conex = new mysqli($host, $user, $password, $db);
    
    if ($conex->connect_error) {
        die("La conexión a la base de datos falló: " . $conex->connect_error);
    }
    
    
?>