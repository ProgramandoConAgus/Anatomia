<?php
if (isset($_GET['id'])) {
    $idVideo = $_GET['id'];
    include("../con_db.php");

    $sql = "DELETE FROM videos WHERE IdVideo = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param('i', $idVideo);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header('Location: panel-inicial.php?id=' . $_SESSION['idUsuario'] );
        exit();
    } else {
        echo "Error al eliminar el video.";
    }

    $stmt->close();

}
?>