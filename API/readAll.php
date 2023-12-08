<?php
require_once 'dbConfig.php';
require_once 'Event.php';

// Create an Event instance
$event = new Event($dbConnection);

// Call the readAll method
$events = $event->readAll();

// Output the events in JSON format
echo json_encode($events);
?>