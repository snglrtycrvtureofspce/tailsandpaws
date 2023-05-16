<?php
// Проверяем, был ли отправлен запрос поиска
if (isset($_GET['doctor_id'])) {
    // Получаем значение выбранного врача
    $doctorID = $_GET['doctor_id'];

    // Подключение к базе данных
    $servername = 'localhost'; // Имя сервера базы данных
    $username = 'root'; // Имя пользователя базы данных
    $password = 'mysql'; // Пароль базы данных
    $dbname = 'petsdb'; // Имя базы данных

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Запрос для поиска записей на услуги, в которых участвует выбранный врач
    $sql = "SELECT * FROM Appointments WHERE DoctorID = '$doctorID'";
    $result = $conn->query($sql);

    // Вывод результатов поиска
    if ($result->num_rows > 0) {
        echo "<h3>Результаты поиска</h3>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID записи</th>";
        echo "<th>Врач</th>";
        echo "<th>Услуга</th>";
        echo "<th>Дата и время</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["AppointmentID"] . "</td>";
            
            // Получаем информацию о враче
            $doctorID = $row["DoctorID"];
            $doctorSql = "SELECT * FROM Doctors WHERE DoctorID = '$doctorID'";
            $doctorResult = $conn->query($doctorSql);
            $doctorRow = $doctorResult->fetch_assoc();
            $doctorName = $doctorRow["DoctorName"];
            
            echo "<td>" . $doctorName . "</td>";
    
            // Получаем информацию об услуге
            $serviceID = $row["ServiceID"];
            $serviceSql = "SELECT * FROM Services WHERE ServiceID = '$serviceID'";
            $serviceResult = $conn->query($serviceSql);
            $serviceRow = $serviceResult->fetch_assoc();
            $serviceName = $serviceRow["ServiceName"];
    
            echo "<td>" . $serviceName . "</td>";
            echo "<td>" . $row["AppointmentDateTime"] . "</td>";
            echo "</tr>";
        }
    
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Нет результатов для выбранного врача.</p>";
    }
    
    // Закрытие соединения с базой данных
    $conn->close();
} else {
    echo "<p>Запрос поиска не отправлен.</p>";
    }
    
?>