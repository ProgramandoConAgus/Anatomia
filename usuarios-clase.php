<?php


class Usuario {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE IdUsuario = ?";
        $stmt = $this->conex->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            return $usuario;
        } else {
            return null;
        }
    }
}
?>
