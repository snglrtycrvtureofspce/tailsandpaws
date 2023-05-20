<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Администратор - Зоомир</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Администрирование БД</h2>
        <h3>Поиск по врачам</h3>
        <form action="search.php" method="GET">
            <label for="doctor">Выберите врача:</label>
            <select name="doctor" id="doctor">
                <?php
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

                // Запрос для получения списка врачей
                $sql = "SELECT * FROM Doctors";
                $result = $conn->query($sql);

                // Вывод списка врачей в выпадающий список
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["DoctorID"] . "'>" . $row["DoctorName"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Нет доступных врачей</option>";
                }

                // Закрытие соединения с базой данных
                $conn->close();
                ?>
            </select>
            <button type="submit">Найти</button>
        </form>
        <h3>Поиск по услугам</h3>
        <form action="search_service.php" method="GET">
            <label for="service">Выберите услугу:</label>
            <select name="service" id="service">
                <?php
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

                // Запрос для получения списка услуг
                $sql = "SELECT * FROM Services";
                $result = $conn->query($sql);

                // Вывод списка услуг в выпадающий список
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["ServiceID"] . "'>" . $row["ServiceName"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Нет доступных услуг</option>";
                }
                // Закрытие соединения с базой данных
                $conn->close();
                ?>
            </select>
            <button type="submit">Найти</button>
        </form>
        <h3>Список услуг</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID услуги</th>
                    <th>Цена услуги</th>
                    <th>Наименование услуги</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <!-- Здесь будет вывод списка услуг из базы данных -->
                <?php
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

                // Запрос для получения списка услуг
                $sql = "SELECT * FROM Services";
                $result = $conn->query($sql);

                // Вывод списка услуг
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ServiceID"] . "</td>";
                        echo "<td>" . $row["ServicePrice"] . "</td>";
                        echo "<td>" . $row["ServiceName"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_service.php?id=" . $row["ServiceID"] . "'>Редактировать</a> | ";
                        echo "<a href='delete_service.php?id=" . $row["ServiceID"] . "'>Удалить</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Нет доступных услуг</td></tr>";
                }

                // Закрытие соединения с базой данных
                $conn->close();
                ?>
                <tr>
                    <td colspan="4">
                        <a href="add_service.php">Добавить</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <h3>Список врачей</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID врача</th>
                    <th>ФИО врача</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <!-- Здесь будет вывод списка врачей из базы данных -->
                <?php
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

                // Запрос для получения списка врачей
                $sql = "SELECT * FROM Doctors";
                $result = $conn->query($sql);

                // Вывод списка врачей
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["DoctorID"] . "</td>";
                        echo "<td>" . $row["DoctorName"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_doctor.php?id=" . $row["DoctorID"] . "'>Редактировать</a> | ";
                        echo "<a href='delete_doctor.php?id=" . $row["DoctorID"] . "'>Удалить</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Нет доступных врачей</td></tr>";
                }

                // Закрытие соединения с базой данных
                $conn->close();
                ?>
                <tr>
                    <td colspan="3">
                        <a href="add_doctor.php">Добавить</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Список записей на прием</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID записи</th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>ID услуги</th>
                    <th>ID врача</th>
                    <th>Дата записи</th>
                    <th>Время записи</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <!-- Здесь будет вывод списка записей на прием из базы данных -->
                <?php
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

                // Запрос для получения списка записей на прием
                $sql = "SELECT * FROM Appointment";
                $result = $conn->query($sql);

                // Вывод списка записей на прием
                if ($result->num_rows > 0) {
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
                        echo "<a href='delete_appointment.php?id=" . $row["AppointmentID"] . "'>Удалить</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Нет доступных записей на прием</td></tr>";
                }
                // Закрытие соединения с базой данных
                $conn->close();
                ?>
                <tr>
                    <td colspan="8">
                        <a href="add_appointment.php">Добавить</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <!-- Popper.js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Owl Carousel js -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Magnific Popup js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- Waypoints js -->
    <script src="js/waypoints.min.js"></script>
    <!-- Countdown js -->
    <script src="js/jquery.countdown.min.js"></script>
    <!-- Isotope js -->
    <script src="js/isotope.pkgd.min.js"></script>
    <!-- Meanmenu js -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- Nice Select js -->
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- ScrollUp js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Slicknav js -->
    <script src="js/jquery.slicknav.min.js"></script>
    <!-- Magnific Popup js -->
    <script src="js/magnific-popup.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>