<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $doctorID = $_POST["doctorID"];
    $doctorName = $_POST["doctorName"];

    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the doctor record in the database
    $sql = "UPDATE Doctors SET DoctorName = '$doctorName' WHERE DoctorID = $doctorID";

    if ($conn->query($sql) === TRUE) {
        echo "Doctor updated successfully.";
    } else {
        echo "Error updating doctor: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
