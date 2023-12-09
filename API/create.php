<?php
require_once 'dbConfig.php';
require_once 'Database.php';

class Event
{
    private $dbConnection;
    private $eventName;
    private $eventDate;
    private $eventTime;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }

    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
    }

    public function setEventTime($eventTime)
    {
        $this->eventTime = $eventTime;
    }

    public function create()
    {
        try {
            $query = "INSERT INTO events (eventName, eventDate, eventTime) VALUES (:eventName, :eventDate, :eventTime)";
            $stmt = $this->dbConnection->prepare($query);

            $stmt->bindParam(':eventName', $this->eventName);
            $stmt->bindParam(':eventDate', $this->eventDate);
            $stmt->bindParam(':eventTime', $this->eventTime);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

// Create a Database instance and connect
$database = new Database();
$dbConnection = $database->connect();

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
