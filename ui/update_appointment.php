<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение из базы данных
    $appointmentID = $_POST["appointmentID"];
    $appointmentFIO = $_POST["appointmentFIO"];
    $appointmentEmail = $_POST["appointmentEmail"];
    $serviceID = $_POST["serviceID"];
    $doctorID = $_POST["doctorID"];
    $appointmentDate = $_POST["appointmentDate"];
    $appointmentTime = $_POST["appointmentTime"];

    // Подключение к базе данных
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Обновление записи в базе данных
    $sql = "UPDATE Appointment SET AppointmentFIO = '$appointmentFIO', AppointmentEmail = '$appointmentEmail', ServiceID = $serviceID, DoctorID = $doctorID, AppointmentDate = '$appointmentDate', AppointmentTime = '$appointmentTime' WHERE AppointmentID = $appointmentID";

    if ($conn->query($sql) === TRUE) {
        // Перенаправление пользователя после успешного добавления
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка обновления записи: " . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
    echo "Неверный запрос.";
}
?>
