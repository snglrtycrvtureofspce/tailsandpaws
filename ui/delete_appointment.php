<?php
// Check if the appointment ID is provided
if (isset($_GET['id'])) {
    $appointmentID = $_GET['id'];

    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the appointment record from the database
    $sql = "DELETE FROM Appointment WHERE AppointmentID = $appointmentID";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment deleted successfully.";
    } else {
        echo "Error deleting appointment: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
