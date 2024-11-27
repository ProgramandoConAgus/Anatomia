<?php
class Events
{
    private $conex;
    private $eventName = "disable_student_annual";
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

        $sqlCreateEvents = "CREATE EVENT $this->eventName ON SCHEDULE EVERY 1 YEAR STARTS '$date' DO
                            UPDATE usuarios SET habilitado = 2 WHERE tipoUsuario <> 2;";
        if ($this->conex->query($sqlCreateEvents) === TRUE) {
            $response['status'] = "success";
            $response['message'] = "Evento creado correctamente con la fecha: $date.";
            $response['date'] = $date;
        } else {
            $response['status'] = "error";
            $response['message'] = "Error al crear el evento: " . $this->conex->error;
        }
        $this->conex->close();
        return json_encode($response);
    }

    public function deletevent()
    {
        $sqlDeleteEvents = "drop event if exists $this->eventName;";
        if ($this->conex->query($sqlDeleteEvents) === TRUE) {
            $response['status'] = "success";
            $response['message'] = "Evento eliminado correctamente.";
        } else {
            $response['status'] = "error";
            $response['message'] = "Error al eliminar el evento: " . $this->conex->error;
        }
        $response['date'] = "";
        return json_encode($response);
    }

    public function getDateEvent()
    {
        $response = [];
        $selectEvents = "SELECT * FROM mysql.event WHERE db = 'u981249563_anato_platform' AND name = 'disable_student_annual';";
        $result = $this->conex->query($selectEvents);
    
        if ($result->num_rows === 1) {
            while ($row = $result->fetch_assoc()) {
                $response['message'] = $row["starts"];
            }
        } else {
            $response['message'] = 'No se encontró el evento solicitado.';
        }
    
    
        return json_encode($response);
    }
}
?>