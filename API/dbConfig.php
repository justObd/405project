<?php

class Database
{
    private $dbHost;
    private $dbPort;
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $dbConnection;

    public function __construct()
    {
        // Set your database credentials here
        $this->dbHost = "your_mariadb_server";
        $this->dbPort = "3306"; // Default MariaDB port
        $this->dbName = "event";
        $this->dbUser = "root";
        $this->dbPassword = "123";
    }

    public function connect()
    {
        try {
            $this->dbConnection = new PDO(
                'mysql:host=' . $this->dbHost . ';port=' . $this->dbPort . ';dbname=' . $this->dbName,
                $this->dbUser,
                $this->dbPassword
            );
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection Error " . $e->getMessage());
        }

        return $this->dbConnection;
    }
}

?>
