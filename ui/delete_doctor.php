<?php
// Check if the doctor ID is provided
if (isset($_GET['id'])) {
    $doctorID = $_GET['id'];

    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        // Delete the doctor record from the database
$sql = "DELETE FROM Doctors WHERE DoctorID = $doctorID";

if ($conn->query($sql) === TRUE) {
    echo "Doctor deleted successfully.";
} else {
    echo "Error deleting doctor: " . $conn->error;
}

// Close the database connection
$conn->close();
} else {
    echo "Invalid request.";
    }
    ?>