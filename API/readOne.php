<?php
require_once 'dbConfig.php';
require_once 'Event.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    // Create an Event instance
    $event = new Event($dbConnection);

    // Set the ID based on the GET data
    $event->setId($_GET['id']);

    // Call the readOne method
    if ($event->readOne()) {
        // Output the event details in JSON format
        echo json_encode($event);
    } else {
        echo 'Event not found';
    }
} else {
    echo 'Event ID not provided';
}
?>
