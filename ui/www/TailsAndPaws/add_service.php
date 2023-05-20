<?php
// Подключение к базе данных и другие необходимые настройки
$servername = 'localhost'; // Имя сервера базы данных
$username = 'root'; // Имя пользователя базы данных
$password = 'mysql'; // Пароль базы данных
$dbname = 'petsdb'; // Имя базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Обработка формы при отправке
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $servicePrice = $_POST['servicePrice'];
    $serviceName = $_POST['serviceName'];

    // Добавление записи в базу данных
    $sql = "INSERT INTO Services (ServiceName, ServicePrice) VALUES ('$serviceName', '$servicePrice')";

    if ($conn->query($sql) === TRUE) {
        // Перенаправление пользователя после успешного добавления
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

// Закрытие подключения
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Добавить услугу</title>
</head>

<body>
    <h1>Добавить услугу</h1>

    <!-- HTML-форма для добавления новой услуги -->
    <form method="POST" action="">
        <label for="serviceName">Цена:</label>
        <input type="text" name="servicePrice" id="servicePrice" required>
        <label for="serviceName">Название услуги:</label>
        <input type="text" name="serviceName" id="serviceName" required>

        <button type="submit">Добавить</button>
    </form>
</body>

</html>