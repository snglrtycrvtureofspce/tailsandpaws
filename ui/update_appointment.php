<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $appointmentID = $_POST["appointmentID"];
    $appointmentFIO = $_POST["appointmentFIO"];
    $appointmentEmail = $_POST["appointmentEmail"];
    $serviceID = $_POST["serviceID"];
    $doctorID = $_POST["doctorID"];
    $appointmentDate = $_POST["appointmentDate"];
    $appointmentTime = $_POST["appointmentTime"];

    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the appointment record in the database
    $sql = "UPDATE Appointment SET AppointmentFIO = '$appointmentFIO', AppointmentEmail = '$appointmentEmail', ServiceID = $serviceID, DoctorID = $doctorID, AppointmentDate = '$appointmentDate', AppointmentTime = '$appointmentTime' WHERE AppointmentID = $appointmentID";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment updated successfully.";
    } else {
        echo "Error updating appointment: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
