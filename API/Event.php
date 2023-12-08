<?php

class Event
{
    private $id;
    private $eventName;
    private $eventDate;
    private $eventTime;
    private $dbConnection;
    private $dbTable = 'events';

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    // Getter and setter methods for each property...

    public function setId($id)
    {
        $this->id = $id;
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
        $query = "INSERT INTO " . $this->dbTable . "(eventName, eventDate, eventTime) VALUES(:eventName, :eventDate, :eventTime)";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":eventName", $this->eventName);
        $stmt->bindParam(":eventDate", $this->eventDate);
        $stmt->bindParam(":eventTime", $this->eventTime);

        if ($stmt->execute()) {
            return true;
        }

        // Print an error message
        printf("Error: %s", $stmt->error);
        return false;
    }

    public function readOne()
    {
        $query = "SELECT * FROM " . $this->dbTable . " WHERE id=:id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute() && $stmt->rowCount() == 1) {
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $this->id = $result->id;
            $this->eventName = $result->eventName;
            $this->eventDate = $result->eventDate;
            $this->eventTime = $result->eventTime;

            return true;
        }

        return false;
    }

    public function readAll()
    {
        $query = "SELECT * FROM " . $this->dbTable;
        $stmt = $this->dbConnection->prepare($query);

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function update()
    {
        $query = "UPDATE " . $this->dbTable . " SET eventName=:eventName, eventDate=:eventDate, eventTime=:eventTime WHERE id=:id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":eventName", $this->eventName);
        $stmt->bindParam(":eventDate", $this->eventDate);
        $stmt->bindParam(":eventTime", $this->eventTime);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute() && $stmt->rowCount() == 1) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->dbTable . " WHERE id=:id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute() && $stmt->rowCount() == 1) {
            return true;
        }

        return false;
    }
}
?>
