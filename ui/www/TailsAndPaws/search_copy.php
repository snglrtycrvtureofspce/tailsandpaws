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
    // Проверка, выбран ли врач для поиска
    if (isset($_GET['doctor']) && !empty($_GET['doctor'])) {
        // Получение выбранного врача из запроса
        $selectedDoctor = $_GET['doctor'];

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

        // Запрос для получения записей на прием для выбранного врача
        $sql = "SELECT * FROM Appointment WHERE DoctorID = '$selectedDoctor'";
        $result = $conn->query($sql);

        // Вывод списка записей на прием для выбранного врача
        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID записи</th>";
            echo "<th>ФИО</th>";
            echo "<th>Email</th>";
            echo "<th>Услуга</th>";
            echo "<th>Врач</th>";
            echo "<th>Дата записи</th>";
            echo "<th>Время записи</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                // Запрос для получения названия услуги
                $sql_service = "SELECT ServiceName FROM Services WHERE ServiceID = '" . $row["ServiceID"] . "'";
                $result_service = $conn->query($sql_service);
                $service_name = "";
                if ($result_service->num_rows > 0) {
                    $row_service = $result_service->fetch_assoc();
                    $service_name = $row_service["ServiceName"];
                }

                // Запрос для получения названия врача
                $sql_doctor = "SELECT DoctorName FROM Doctors WHERE DoctorID = '" . $row["DoctorID"] . "'";
                $result_doctor = $conn->query($sql_doctor);
                $doctor_name = "";
                if ($result_doctor->num_rows > 0) {
                    $row_doctor = $result_doctor->fetch_assoc();
                    $doctor_name = $row_doctor["DoctorName"];
                }

                echo "<tr>";
                echo "<td>" . $row["AppointmentID"] . "</td>";
                echo "<td>" . $row["AppointmentFIO"] . "</td>";
                echo "<td>" . $row["AppointmentEmail"] . "</td>";
                echo "<td>" . $service_name . "</td>";
                echo "<td>" . $doctor_name . "</td>";
                echo "<td>" . $row["AppointmentDate"] . "</td>";
                echo "<td>" . $row["AppointmentTime"] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Нет записей на прием для выбранного врача</p>";
        }

        // Закрытие соединения с базой данных
        $conn->close();
    } else {
        echo "<p>Выберите врача для поиска</p>";
    }
    ?>
</body>

</html>
