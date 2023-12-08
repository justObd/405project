<?php
require_once 'dbConfig.php';
require_once 'Event.php';

// Check if the ID is provided
if (isset($_POST['id'])) {
    // Create an Event instance
    $event = new Event($dbConnection);

    // Set properties based on the POST data
    $event->setId($_POST['id']);
    $event->setEventName($_POST['eventName']);
    $event->setEventDate($_POST['eventDate']);
    $event->setEventTime($_POST['eventTime']);

    // Call the update method
    if ($event->update()) {
        echo 'Event updated successfully';
    } else {
        echo 'Error updating event';
    }
} else {
    echo 'Event ID not provided';
}
?>
