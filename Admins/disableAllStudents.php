<?php
include('../con_db.php');
include('../eventsClass.php');

$events = new Events($conex);

$date = $_POST['date'] ?? null;

header('Content-Type: application/json');
echo $events->disableAllStudentForEvents($date);

?>