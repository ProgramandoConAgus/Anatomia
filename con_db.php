<?php
    $host = 'srv1310.hstgr.io'; // Cambia esto si tu host es diferente
    $db = 'u981249563_anato_platform';
    $user = 'u981249563_anato_platform';
    $password = '4n4t0_Plat4f0rm4';
    
    $conex = new mysqli($host, $user, $password, $db);
    
    if ($conex->connect_error) {
        die("La conexión a la base de datos falló: " . $conex->connect_error);
    }
    
    
?>