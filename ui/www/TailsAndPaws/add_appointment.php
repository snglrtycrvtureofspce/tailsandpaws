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

// Получение данных для выпадающего списка услуг
$sqlServices = "SELECT ServiceID, ServiceName FROM Services";
$resultServices = $conn->query($sqlServices);

// Получение данных для выпадающего списка врачей
$sqlDoctors = "SELECT DoctorID, DoctorName FROM Doctors";
$resultDoctors = $conn->query($sqlDoctors);

// Обработка формы при отправке
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $appointmentFIO = $_POST['appointmentFIO'];
    $appointmentEmail = $_POST['appointmentEmail'];
    $serviceID = $_POST['serviceID'];
    $doctorID = $_POST['doctorID'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];

    // Добавление записи в базу данных
    $sql = "INSERT INTO Appointment (AppointmentFIO, AppointmentEmail, ServiceID, DoctorID, AppointmentDate, AppointmentTime)
            VALUES ('$appointmentFIO', '$appointmentEmail', $serviceID, $doctorID, '$appointmentDate', '$appointmentTime')";

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
    <title>Добавить запись на прием</title>
</head>

<body>
    <h1>Добавить запись на прием</h1>

    <!-- HTML-форма для добавления новой записи на прием -->
    <form method="POST" action="">
        <label for="appointmentFIO">ФИО пациента:</label>
        <input type="text" name="appointmentFIO" id="appointmentFIO" required>

        <label for="appointmentEmail">Email пациента:</label>
        <input type="email" name="appointmentEmail" id="appointmentEmail" required>

        <label for="serviceID">Услуга:</label>
        <select name="serviceID" id="serviceID" required>
            <?php
            if ($resultServices->num_rows > 0) {
                while ($row = $resultServices->fetch_assoc()) {
                    echo '<option value="' . $row['ServiceID'] . '">' . $row['ServiceName'] . '</option>';
                }
            }
            ?>
        </select>

        <label for="doctorID">Врач:</label>
        <select name="doctorID" id="doctorID" required>
            <?php
            if ($resultDoctors->num_rows > 0) {
                while ($row = $resultDoctors->fetch_assoc()) {
                    echo '<option value="' . $row['DoctorID'] . '">' . $row['DoctorName'] . '</option>';
                }
            }
            ?>
        </select>

        <label for="appointmentDate">Дата приема:</label>
        <input type="date" name="appointmentDate" id="appointmentDate" required>

        <label for="appointmentTime">Время приема:</label>
        <input type="time" name="appointmentTime" id="appointmentTime" required>

        <button type="submit">Добавить</button>
    </form>
</body>

</html>