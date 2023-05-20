<?php
// Проверка на предоставление service id
if (isset($_GET['id'])) {
    $serviceID = $_GET['id'];

    // Подключение к базе данных
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Запрос на удаление услуги с базы данных
    $sql = "DELETE FROM Services WHERE ServiceID = $serviceID";
    if ($conn->query($sql) === TRUE) {
        // Перенаправление пользователя после успешного добавления
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка удаления услуги: " . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
    echo "Неверный запрос.";
}
?>
