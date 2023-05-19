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
    $doctorName = $_POST['doctorName'];

    // Добавление записи в базу данных
    $sql = "INSERT INTO Doctors (DoctorName) VALUES ('$doctorName')";

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
    <title>Добавить врача</title>
</head>

<body>
    <h1>Добавить врача</h1>

    <!-- HTML-форма для добавления нового врача -->
    <form method="POST" action="">
        <label for="doctorName">Имя врача:</label>
        <input type="text" name="doctorName" id="doctorName" required>

        <button type="submit">Добавить</button>
    </form>
</body>

</html>