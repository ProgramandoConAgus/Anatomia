<?php


class UsuarioCurso {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }
    public function obtenerCursosPorId($id) {
        $sql = "SELECT uc.*, c.* 
                FROM usuarioscursos uc
                JOIN cursos c ON uc.idCurso = c.IdCurso
                WHERE uc.idUsuario = ?;";
        $stmt = $this->conex->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $cursos = []; 
        while ($row = $result->fetch_assoc()) {
            $cursos[] = $row; 
        }
    
        return !empty($cursos) ? $cursos : null; 
    }
    

}