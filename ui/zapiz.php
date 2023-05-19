<!DOCTYPE html>
<html>

<head>
  <title>Запись на услугу</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <style>
    html,
    body {
      min-height: 100%;
    }

    body,
    div,
    form,
    input,
    select,
    textarea,
    label,
    p {
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
    }

    h1 {
      position: absolute;
      margin: 0;
      font-size: 40px;
      color: #fff;
      z-index: 2;
      line-height: 83px;
    }

    textarea {
      width: calc(100% - 12px);
      padding: 5px;
    }

    .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
    }

    form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 8px #006622;
    }

    .banner {
      position: relative;
      height: 300px;
      background-color: 1px solid #ccc;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .banner::after {
      content: "";
      background-color: rgba(238, 130, 238);
      position: absolute;
      width: 100%;
      height: 100%;
    }

    input,
    select,
    textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    input {
      width: calc(100% - 10px);
      padding: 5px;
    }

    input[type="date"] {
      padding: 4px 5px;
    }

    textarea {
      width: calc(100% - 12px);
      padding: 5px;
    }

    .item:hover p,
    .item:hover i,
    .question:hover p,
    .question label:hover,
    input:hover::placeholder {
      color: #006622;
    }

    .item input:hover,
    .item select:hover,
    .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 3px 0 #006622;
      color: #006622;
    }

    .item {
      position: relative;
      margin: 10px 0;
    }

    .item span {
      color: red;
    }

    input[type="date"]::-webkit-inner-spin-button {
      display: none;
    }

    .item i,
    input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      font-size: 20px;
      color: #00b33c;
    }

    button[type="submit"] {

      padding: 10px;
      background-color: #ff7fca;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #ff7fca;
    }

    .item i {
      right: 1%;
      top: 30px;
      z-index: 1;
    }

    .week {
      display: flex;
      justify-content: space-between;
    }

    .colums {
      display: flex;
      justify-content: space-between;
      flex-direction: row;
      flex-wrap: wrap;
    }

    .colums div {
      width: 48%;
    }

    [type="date"]::-webkit-calendar-picker-indicator {
      right: 1%;
      z-index: 2;
      opacity: 0;
      cursor: pointer;
    }

    input[type=radio],
    input[type=checkbox] {
      display: none;
    }

    label.radio {
      position: relative;
      display: inline-block;
      margin: 5px 20px 15px 0;
      cursor: pointer;
    }

    .question span {
      margin-left: 30px;
    }

    .question-answer label {
      display: block;
    }

    label.radio:before {
      content: "";
      position: absolute;
      left: 0;
      width: 17px;
      height: 17px;
      border-radius: 50%;
      border: 2px solid #ccc;
    }

    input[type=radio]:checked+label:before,
    label.radio:hover:before {
      border: 2px solid #006622;
    }

    label.radio:after {
      content: "";
      position: absolute;
      top: 6px;
      left: 5px;
      width: 8px;
      height: 4px;
      border: 3px solid #006622;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
    }

    input[type=radio]:checked+label:after {
      opacity: 1;
    }

    .flax {
      display: flex;
      justify-content: space-around;
    }

    .btn-block {
      margin-top: 10px;
      text-align: center;
    }

    button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background: #006622;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
    }

    button:hover {
      background: #00b33c;
    }

    @media (min-width: 568px) {

      .name-item,
      .city-item {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
      }

      .name-item input,
      .name-item div {
        width: calc(50% - 20px);
      }

      .name-item div input {
        width: 97%;
      }

      .name-item div label {
        display: block;
        padding-bottom: 5px;
      }
    }

    .success-message {
      background-color: #c9f4cd;
      color: #276749;
      padding: 10px;
      border-radius: 4px;
    }

    .error-message {
      background-color: #f8d7da;
      color: #721c24;
      padding: 10px;
      border-radius: 4px;
    }
  </style>
</head>

<body>
  <?php
  // Обработка отправки формы
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $serviceID = $_POST['service'];
    $doctorID = $_POST['doctor'];
    $date = $_POST['bdate'];
    $time = $_POST['appt'];

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

    // Подготовка и выполнение запроса вставки записи
    $sql = "INSERT INTO Appointment (AppointmentFIO, AppointmentEmail, ServiceID, DoctorID, AppointmentDate, AppointmentTime)
              VALUES ('$fname', '$email', '$serviceID', '$doctorID', '$date', '$time')";
    if ($conn->query($sql) === true) {
      echo '<div class="success-message">Запись успешно добавлена.</div>';

      // Получение названия услуги
      $serviceSql = "SELECT ServiceName FROM Services WHERE ServiceID = '$serviceID'";
      $serviceResult = $conn->query($serviceSql);
      $serviceName = $serviceResult->fetch_assoc()['ServiceName'];

      // Получение имени врача
      $doctorSql = "SELECT DoctorName FROM Doctors WHERE DoctorID = '$doctorID'";
      $doctorResult = $conn->query($doctorSql);
      $doctorName = $doctorResult->fetch_assoc()['DoctorName'];

      // Отправка письма на указанный адрес электронной почты
      $from = "tailsandpawsclinic@gmail.com";
      $to = $email;
      $subject = 'Запись на услугу';
      $message = 'Уважаемый(ая) ' . $fname . ', ваша запись на услугу "' . $serviceName . '" у врача ' . $doctorName . ' на ' . $date . ' в ' . $time . ' была успешно оформлена.';
      $headers = ["From: $from"];

      if (mail($to, $subject, $message, implode("\n", $headers))) {
        echo '<div class="success-message">Письмо успешно отправлено.</div>';
      } else {
        echo '<div class="error-message">Ошибка при отправке письма.</div>';
      }
    } else {
      echo '<div class="error-message">Ошибка при добавлении записи: ' . $conn->error . '</div>';
    }

    $conn->close();
  }
  ?>
  <div class="testbox">
    <form method="POST" action="zapiz.php" onsubmit="return validateForm()">
      <div class="banner">
        <h1>Запись на услугу</h1>
      </div>
      <br />
      <fieldset>
        <legend>Введите ваши данные</legend>
        <div class="item">
          <label for="fname">ФИО<span>*</span></label>
          <input id="fname" type="text" name="fname" />
        </div>
        <div class="item">
          <label for="email">E-mail<span>*</span></label>
          <input type="email" id="email" name="email" placeholder="example@example.com" required>
        </div>
        <div class="item">
          <p>Выбор услуги</p>
          <select name="service" id="service" onchange="updateServicePrice()">
            <option value="">Не выбрано</option>
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

            // Получение списка услуг из базы данных
            $sql = "SELECT ServiceID, ServiceName, ServicePrice FROM Services";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['ServiceID'] . '">' . $row['ServiceName'] . '</option>';
              }
            }

            $conn->close();
            ?>
          </select>
          <p>Цена: <span id="servicePrice">0,00</span> руб.</p>
        </div>
        <div class="item">
          <p>Выбор врача</p>
          <select name="doctor" id="doctor">
            <option value="">Не выбрано</option>
            <?php
            // Подключение к базе данных
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Проверка соединения с базой данных
            if ($conn->connect_error) {
              die('Ошибка подключения к базе данных: ' . $conn->connect_error);
            }

            // Получение списка врачей из базы данных
            $sql = "SELECT DoctorID, DoctorName FROM Doctors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['DoctorID'] . '">' . $row['DoctorName'] . '</option>';
              }
            }

            $conn->close();
            ?>
          </select>
        </div>
        <div class="item">
          <label for="bdate">Выберите дату <span>*</span></label>
          <input id="bdate" type="date" name="bdate" required />
        </div>
        <div class="item">
          <label for="appt">Выберите время <span>*</span></label>
          <input id="appt" type="time" name="appt" required />
        </div>
      </fieldset>
      <div class="btn-block">
        <button type="submit" href="/">Отправить</button>
      </div>
    </form>
</body>
<script>
  function updateServicePrice() {
    // Получаем выбранную услугу
    var serviceSelect = document.getElementById("service");
    var selectedService = serviceSelect.options[serviceSelect.selectedIndex];

    // Получаем идентификатор выбранной услуги
    var serviceId = selectedService.value;

    // Выполняем AJAX-запрос для получения цены услуги из базы данных
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Обновляем поле с ценой на форме
        document.getElementById("servicePrice").textContent = this.responseText;
      }
    };
    xhttp.open("GET", "get_price.php?serviceId=" + serviceId, true);
    xhttp.send();
  }

  function validateEmail(email) {
    // Регулярное выражение для проверки email
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }

  function validateForm() {
    var service = document.getElementById("service").value;
    var doctor = document.getElementById("doctor").value;
    var fname = document.getElementById("fname").value;
    var emailInput = document.getElementById("email");
    var email = emailInput.value.trim();

    if (service === "") {
      alert("Пожалуйста, выберите услугу");
      return false; // Отмена отправки формы
    }

    if (doctor === "") {
      alert("Пожалуйста, выберите врача");
      return false; // Отмена отправки формы
    }

    if (fname === "") {
      alert("Пожалуйста, введите ФИО.");
      return false; // Отмена отправки формы
    }

    // Проверка на пустое поле email
    if (email === "") {
      alert("Пожалуйста, введите email.");
      emailInput.focus();
      return false;
    }

    // Проверка на корректность email
    if (!validateEmail(email)) {
      alert("Пожалуйста, введите корректный email. Пример: example@example.com");
      emailInput.focus();
      return false;
    }

    return true; // Разрешение отправки формы
  }
</script>

</html>