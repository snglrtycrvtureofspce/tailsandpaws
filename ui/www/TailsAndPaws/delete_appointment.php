<?php
// Проверка на предоставление appointment id
if (isset($_GET['id'])) {
    $appointmentID = $_GET['id'];

    // Подключение к базе данных
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Запрос на удаление записи  с базы данных
    $sql = "DELETE FROM Appointment WHERE AppointmentID = $appointmentID";

    if ($conn->query($sql) === TRUE) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка удаления записи: " . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
    echo "Неверный запрос.";
}
?>
