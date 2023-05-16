<?php
// Check if the form is submitted and the service ID is provided
if (isset($_POST['serviceID']) && isset($_POST['servicePrice']) && isset($_POST['serviceName'])) {
    $serviceID = $_POST['serviceID'];
    $servicePrice = $_POST['servicePrice'];
    $serviceName = $_POST['serviceName'];

    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the service record in the database
    $sql = "UPDATE Services SET ServicePrice = '$servicePrice', ServiceName = '$serviceName' WHERE ServiceID = $serviceID";

    if ($conn->query($sql) === TRUE) {
        echo "Service updated successfully.";
    } else {
        echo "Error updating service: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>