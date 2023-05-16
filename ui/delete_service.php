<?php
// Check if the service ID is provided
if (isset($_GET['id'])) {
    $serviceID = $_GET['id'];

    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the service record from the database
    $sql = "DELETE FROM Services WHERE ServiceID = $serviceID";
    if ($conn->query($sql) === TRUE) {
        echo "Service deleted successfully.";
    } else {
        echo "Error deleting service: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
    }
?>    