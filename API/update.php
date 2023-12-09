<?php
require_once 'dbConfig.php';
require_once 'Database.php';
require_once 'Event.php';

class EventApi
{
    private $dbConnection;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function update()
    {
        // Check if the ID is provided
        if (!isset($_POST['id'])) {
            echo 'Event ID not provided';
            return;
        }

        // Create an Event instance
        $event = new Event($this->dbConnection);

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
    }
}

// Create a Database instance and connect
$database = new Database();
$dbConnection = $database->connect();

// Instantiate EventApi object
$eventApi = new EventApi($dbConnection);

// Check Request Method
if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
    header('Allow: PUT');
    http_response_code(405);
    echo json_encode('Method Not Allowed');
    return;
}

// Response Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

// Call the update method
$eventApi->update();
?>
