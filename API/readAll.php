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

    public function readAll()
    {
        // Create an Event instance
        $event = new Event($this->dbConnection);

        // Call the readAll method
        $events = $event->readAll();

        // Output the events in JSON format
        echo json_encode($events);
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

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

// Call the readAll method
$eventApi->readAll();
?>
