<?php
// Проверка на предоставление doctor id
if (isset($_GET['id'])) {
    $doctorID = $_GET['id'];

    // Подключение к базе данных
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Запрос на удаление врача с базы данных
    $sql = "DELETE FROM Doctors WHERE DoctorID = $doctorID";

    if ($conn->query($sql) === TRUE) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка удаления врача: " . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
    echo "Неверный запрос.";
}
?>
