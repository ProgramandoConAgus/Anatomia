<?php
// Supongamos que $id es una cadena con valores separados por puntos.
$id = "1.2.3.4.5.6"; // Ejemplo de entrada

$message = ""; // Inicializa la variable de mensaje
$id = explode(".", $id); // Divide la cadena en un array utilizando el punto como separador

foreach ($id as $value) {
    $ID = (int)$value; // Convierte cada elemento a entero
    if ($ID % 2 == 0) { // Verifica si el número es par
        $message .= "Hola " . $ID . " "; // Usa .= para concatenar con un espacio
    }
}

echo $message; // Muestra el mensaje final
?>
