<!DOCTYPE html>
<html>

<head>
    <title>Результаты поиска</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Результаты поиска</h2>

    <?php
    // Проверка выбранной услуги
    if (isset($_GET['service']) && !empty($_GET['service'])) {
        $serviceID = $_GET['service'];

        // Подключение к базе данных
        $servername = 'localhost';
        $username = 'root';
        $password = 'mysql';
        $dbname = 'petsdb';

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Проверка подключения
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        // Запрос для получения записей на прием для выбранной услуги
        $sql = "SELECT * FROM Appointment WHERE ServiceID = '$serviceID'";
        $result = $conn->query($sql);

        // Проверка выполнения запроса
        if ($result) {
            // Вывод таблицы с результатами поиска
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID записи</th>";
                echo "<th>ФИО пациента</th>";
                echo "<th>Email пациента</th>";
                echo "<th>ID услуги</th>";
                echo "<th>ID врача</th>";
                echo "<th>Дата записи</th>";
                echo "<th>Время записи</th>";
                echo "<th>Действия</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["AppointmentID"] . "</td>";
                    echo "<td>" . $row["AppointmentFIO"] . "</td>";
                    echo "<td>" . $row["AppointmentEmail"] . "</td>";
                    echo "<td>" . $row["ServiceID"] . "</td>";
                    echo "<td>" . $row["DoctorID"] . "</td>";
                    echo "<td>" . $row["AppointmentDate"] . "</td>";
                    echo "<td>" . $row["AppointmentTime"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_appointment.php?id=" . $row["AppointmentID"] . "'>Редактировать</a> | ";
                    echo "<a href='delete_appointment.php?id=" . $row["AppointmentID"] . "'>Удалить</a";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Нет записей на прием для выбранной услуги</p>";
            }
        } else {
            echo "Ошибка выполнения запроса: " . $conn->error;
        }

        // Закрытие соединения с базой данных
        $conn->close();
    } else {
        echo "<p>Выберите услугу для поиска записей на прием</p>";
    }
    ?>
</body>

</html>