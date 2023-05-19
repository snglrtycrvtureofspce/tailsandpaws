<?php
if (isset($_POST['serviceID']) && isset($_POST['servicePrice']) && isset($_POST['serviceName'])) {
    $serviceID = $_POST['serviceID'];
    $servicePrice = $_POST['servicePrice'];
    $serviceName = $_POST['serviceName'];

    // Подключение к базе данных
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Обновление врача в базе данных
    $sql = "UPDATE Services SET ServicePrice = '$servicePrice', ServiceName = '$serviceName' WHERE ServiceID = $serviceID";

    if ($conn->query($sql) === TRUE) {
        // Перенаправление пользователя после успешного добавления
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка обновления услуги: " . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
    echo "Неверный запрос.";
}
?>