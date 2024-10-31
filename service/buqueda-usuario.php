<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$text = $_POST['busqueda-texto'];
$idCurso = $_POST['id-curso-busqueda'];

include('../con_db.php');
include('../usuarios-clase.php');

$usuario = new Usuario($conex);

$usuarioBuscado = $usuario->buscarUsuario($text,$idCurso);

if ($usuarioBuscado) {
    $_SESSION['usuario-busqueda'] = $usuarioBuscado;
} else {
   
}

header('Location: ../Admins/panel-admin.php');
exit(); 
?>