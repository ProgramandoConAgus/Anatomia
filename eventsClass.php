<?php
class Events{
    private $conex;
    private $eventName = "Deshabilitar Cursos de Todos";

    public function __construct($conex)
    {
        $this->conex = $conex;
    }

    public function disableAllStudentForEvents($date)
    {
        $response = [];

        if (!$date || empty($date)) {
            $response['status'] = "error";
            $response['message'] = "La fecha no fue proporcionada.";
            return json_encode($response);
        }

        $dateObject = DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateObject || $dateObject->format('Y-m-d') !== $date) {
            $response['status'] = "error";
            $response['message'] = "Formato de fecha inválido. Se esperaba 'YYYY-MM-DD'.";
            return json_encode($response);
        }
        $this->deletevent();

        $sqlCreateEvents = "CREATE EVENT `$this->eventName` ON SCHEDULE EVERY 1 YEAR STARTS '$date' DO
                            UPDATE usuarios SET habilitado = 2 WHERE tipoUsuario <> 2;";
        if ($this->conex->query($sqlCreateEvents) === TRUE) {
            $response['status'] = "success";
            $response['message'] = "Evento creado correctamente con la fecha: $date.";
            $response['date'] = $date;
        } else {
            $response['status'] = "error";
            $response['message'] = "Error al crear el evento: " . $this->conex->error;
        }
        return json_encode($response);
    }

    public function disableStudentsByCourse($date, $cursos)
    {
        $response = [];

        
        if (!$date || empty($date)) {
            $response['status'] = "error";
            $response['message'] = "La fecha no fue proporcionada.";
            return json_encode($response);
        }
        
        $idCurso = intval($cursos[0]); // Sanitización de idCurso
        
        $dateObject = DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateObject || $dateObject->format('Y-m-d') !== $date) {
            $response['status'] = "error";
            $response['message'] = "Formato de fecha inválido. Se esperaba 'YYYY-MM-DD'.";
            return json_encode($response);
        }
        $this->deletevent();
        
        $this->eventName = "Deshabilitar Cursos de " . $cursos[1];
        $sqlCreateEvents = "CREATE EVENT `$this->eventName` ON SCHEDULE EVERY 1 YEAR STARTS '$date' DO
                            UPDATE usuarios SET habilitado = 2 WHERE tipoUsuario <> 2 AND idCurso = $idCurso;";
        if ($this->conex->query($sqlCreateEvents) === TRUE) {
            $response['status'] = "success";
            $response['message'] = "Evento creado correctamente con la fecha: $date.";
            $response['date'] = $date;
        } else {
            $response['status'] = "error";
            $response['message'] = "Error al crear el evento: " . $this->conex->error;
        }
        return json_encode($response);
    }

    public function deletevent($curso="todos")
    {
        if(isset($_POST['curso'])){
            $curso=$_POST['curso'];
        }
        $this->eventName="Deshabilitar Cursos de ".$curso;
        $response = [];
        $sqlDeleteEvents = "DROP EVENT IF EXISTS `$this->eventName`;";
        
        try {
            if ($this->conex->query($sqlDeleteEvents) === TRUE) {
                $response['status'] = "success";
                $response['message'] = "Evento eliminado correctamente.";
            } else {
                throw new Exception("Error al eliminar el evento: " . $this->conex->error);
            }
        } catch (Exception $e) {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();
        }
        return json_encode($response);
    }

    public function getAllEvents()
{
    $response = [];
    // Consulta para obtener todos los eventos programados en la base de datos
    $selectEvents = "SELECT name, starts FROM mysql.event WHERE db = 'u981249563_anato_platform';";
    $result = $this->conex->query($selectEvents);

    if ($result->num_rows > 0) {
        $response['status'] = 'success';
        $events = [];
        // Recorremos todos los eventos encontrados
        while ($row = $result->fetch_assoc()) {
            $events[] = [
                'name' => $row['name'],
                'starts' => $row['starts']
            ];
        }
        $response['events'] = $events;
    } else {
        $response['status'] = 'noEvents';
        $response['message'] = 'No se encontraron eventos.';
    }

    return json_encode($response);
}
}

?>
