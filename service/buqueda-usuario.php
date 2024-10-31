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

$_SESSION['parametro-busqueda-texto'] = $text; 
$_SESSION['parametro-busqueda-idCurso'] = $idCurso; 

$_SESSION['busqueda-usuario-activo'] = true; 
$_SESSION['usuario-busqueda'] = $usuarioBuscado;

header('Location: ../Admins/panel-admin.php');
exit(); 
?>