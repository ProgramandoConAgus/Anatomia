<?php


class Usuario {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT *
        FROM usuario
        JOIN cursos ON usuarios.idCurso = cursos.IdCurso
        WHERE usuarios.IdUsuario = ?;
        ";
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
// Segundo Parametro

public function buscarUsuario($texto,$idCurso) {
    $sql = '';
    $stmt = null;
    $todosLosCursos = -1;
    if ($texto != null && $idCurso != $todosLosCursos){
        $sql= "SELECT * FROM usuarios WHERE nombre like ? or apellido like ? or email like ? AND idCurso = ?";
        $texto = strtolower($texto);
        $stmt = $this->conex->prepare($sql);
        $stmt->bind_param("ssss", $texto);
    }else if ($texto != null && $idCurso == $todosLosCursos){
        $sql = "SELECT * FROM usuarios WHERE nombre like ? or apellido like ? or email like ?" 
    }else if ($texto == null){
         if ($idCurso == $todosLosCursos){
            $sql = "SELECT * FROM usuarios"
         }else{
            $sql = "SELECT * FROM usuarios WHERE idCurso = ?"
         }
    }
    


   
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        return $usuario;
    } else {
        return null;
    }
}

?>
