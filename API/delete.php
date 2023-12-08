<?php
require_once 'dbConfig.php';
require_once 'Event.php';

// Check if the ID is provided
if (isset($_POST['id'])) {
    // Create an Event instance
    $event = new Event($dbConnection);

    // Set the ID based on the POST data
    $event->setId($_POST['id']);

    // Call the delete method
    if ($event->delete()) {
        echo 'Event deleted successfully';
    } else {
        echo 'Error deleting event';
    }
} else {
    echo 'Event ID not provided';
}
?>
