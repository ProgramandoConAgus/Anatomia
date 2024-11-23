<?php
class Events{
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function disableAllStudentForEvents($date) {
        $eventName = "disable_student_annual";
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

        $sqlDeleteEvents = "drop event if exists $eventName;";
        if ($this->conex->query($sqlDeleteEvents) === TRUE) {
            $response['delete_status'] = "Evento eliminado correctamente.";
        } else {
            $response['delete_status'] = "Error al eliminar el evento: " . $this->conex->error;
        }

        $sqlCreateEvents = "CREATE EVENT $eventName ON SCHEDULE EVERY 1 YEAR STARTS '$date' DO
                            UPDATE usuarios SET habilitado = 2 WHERE tipoUsuario <> 2;";
        if ($this->conex->query($sqlCreateEvents) === TRUE) {
            $response['status'] = "success";
            $response['message'] = "Evento creado correctamente con la fecha: $date.";
        } else {
            $response['status'] = "error";
            $response['message'] = "Error al crear el evento: " . $this->conex->error;
        }

        return json_encode($response);
    }
}
