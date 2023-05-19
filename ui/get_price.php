<?php
// Подключение к базе данных
$servername = 'localhost'; // Имя сервера базы данных
$username = 'root'; // Имя пользователя базы данных
$password = 'mysql'; // Пароль базы данных
$dbname = 'petsdb'; // Имя базы данных

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения с базой данных
if ($conn->connect_error) {
  die('Ошибка подключения к базе данных: ' . $conn->connect_error);
}

// Получение идентификатора выбранной услуги
$serviceID = $_GET['serviceId'];

// Подготовка и выполнение запроса для получения цены выбранной услуги
$sql = "SELECT ServicePrice FROM Services WHERE ServiceID = '$serviceID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $servicePrice = $row['ServicePrice'];
  echo $servicePrice;
} else {
  echo '0.00';
}

$conn->close();
