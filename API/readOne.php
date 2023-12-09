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

    public function readOne()
    {
        // Check if the ID is provided
        if (!isset($_GET['id'])) {
            echo 'Event ID not provided';
            return;
        }

        // Create an Event instance
        $event = new Event($this->dbConnection);

        // Set the ID based on the GET data
        $event->setId($_GET['id']);

        // Call the readOne method
        if ($event->readOne()) {
            // Output the event details in JSON format
            echo json_encode($event);
        } else {
            echo 'Event not found';
        }
    }
}

// Create a Database instance and connect
$database = new Database();
$dbConnection = $database->connect();

// Instantiate EventApi object
$eventApi = new EventApi($dbConnection);

// Check Request Method
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    header('Allow: GET');
    http_response_code(405);
    echo json_encode('Method Not Allowed');
    return;
}

// Response Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

// Call the readOne method
$eventApi->readOne();
?>
