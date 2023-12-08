<?php
require_once 'dbConfig.php';
require_once 'Event.php';

// Create an Event instance
$event = new Event($dbConnection);

// Set properties based on the POST data
$event->setEventName($_POST['eventName']);
$event->setEventDate($_POST['eventDate']);
$event->setEventTime($_POST['eventTime']);

// Call the create method
if ($event->create()) {
    echo 'Event added successfully';
} else {
    echo 'Error adding event';
}
?>
