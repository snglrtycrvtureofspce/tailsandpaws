<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение из базы данных
    $doctorID = $_POST["doctorID"];
    $doctorName = $_POST["doctorName"];

    // Подключение к базе данных
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Обновление врача в базе данных
    $sql = "UPDATE Doctors SET DoctorName = '$doctorName' WHERE DoctorID = $doctorID";

    if ($conn->query($sql) === TRUE) {
        // Перенаправление пользователя после успешного добавления
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка обновления врача: " . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
    echo "Неверный запрос";
}
?>
