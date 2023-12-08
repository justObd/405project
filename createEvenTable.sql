CREATE DATABASE IF NOT EXISTS your_database_name;
USE your_database_name;

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eventName VARCHAR(255) NOT NULL,
    eventDate DATE NOT NULL,
    eventTime TIME NOT NULL
);