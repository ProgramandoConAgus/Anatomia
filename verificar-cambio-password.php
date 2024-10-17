<?php
include('con_db.php');
session_start();

$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$confirmpassword = $_POST['confirmpassword'];

if ($newpassword == $confirmpassword) {
    $idUsuario = $_SESSION['idUsuario'];
    
    // Obtener la contraseña hasheada almacenada en la base de datos
    $sql = "SELECT password FROM usuarios WHERE IdUsuario=?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verificar la contraseña antigua
        if (password_verify($oldpassword, $hashed_password)) {
            // Hashear la nueva contraseña
            $new_hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

            // Actualizar la base de datos con la nueva contraseña hasheada
            $sql = "UPDATE usuarios SET password=? WHERE IdUsuario=?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("si", $new_hashed_password, $idUsuario);
            $stmt->execute();

            // Redirigir al panel inicial
            header('Location: panel-inicial.php?id=' . $idUsuario);
            exit();
        } else {
            $_SESSION['error'] = 'La contraseña antigua es incorrecta';
            header('Location: change-password.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Usuario no encontrado';
        header('Location: change-password.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Las nuevas contraseñas no coinciden';
    header('Location: change-password.php');
    exit();
}
?>
