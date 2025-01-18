<?php
session_start();
if (isset($_GET['id'])) {
    $idVideo = $_GET['id'];
    include("../con_db.php");

    $sql = "DELETE FROM pdfs WHERE Idpdf = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param('i', $idVideo);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header('Location: ../panel-inicial.php?id=' . $_SESSION['IdUser'] );
        exit();
    } else {
        echo "Error al eliminar el pdf.";
    }

    $stmt->close();

}
?>