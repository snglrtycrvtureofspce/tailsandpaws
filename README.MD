# "Сайт ветеринарной клиники"

## Структура кода проекта

В корне проекта, в папке .resources, находится вся необходимая информация по структуре проекта.

## Начало работы

Следуя этим инструкциям, вы получите копию проекта на вашей локальной машине для разработки и тестирования.

### Предустановки

Данный проект представляет собой веб-сайт.

### Установка

1. Для начала скачайте и установите приложение Ampps (требуется Apache, MySQL, PHP).

2. Запустите приложение Ampps > Options > Install Apps > Utilities > Sendmail (Install).

3. Потребуется закомментировать некоторые параметры, а также добавить пути (sendmail_path, если у вас другой путь то замените на соответствующий) к sendmail.exe (Ampps > PHP (Settings) > Configuration > PHP conf):

    ```ini
    [mail function]
    ;SMTP = localhost
    ;smtp_port = 25

    ;sendmail_from = me@example.com

    sendmail_path = C:\Program Files\Ampps\sendmail\sendmail.exe

    ;mail.force_extra_parameters =

    ;mail.add_x_header = On

    ;mail.log = syslog
    ```

4. Я буду использовать почтовый ящик от Google - "Gmail". 
    - создайте аккаунт Google.
    - перейдите в "Управление аккаунтом Google". 
    - вкладка "Безопасность". Включите и настройте двухэтапную аутентификацию.
    - в окне "Двухэтапная аутентификация" пролистайте в самый низ и кликните на "Пароли приложений". 
        - во вкладке "Приложение" выберите "Другое" и введите любое название, и нажмите создать. 
        - созданный 16-ти значный ключ будет "auth_password" для нашего sendmail.

5. Теперь перейдите в корневую папку "Ampps" (сделать это можно в самом приложении нажав на "Root Directory"), после перейти в папку "sendmail", открыть файл конфигурации "sendmail.ini" и отредактировать по примеру:

    ```ini
    [sendmail]

    smtp_server=smtp.gmail.com

    ; smtp port (normally 25)

    smtp_port=587

    smtp_ssl=auto

    default_domain=gmail.com

    error_logfile=error.log

    debug_logfile=debug.log

    auth_username=your_gmail@gmail.com
    auth_password=your_key

    pop3_server=
    pop3_username=
    pop3_password=

    force_sender=your_gmail@gmail.com

    force_recipient=

    hostname=gmail.com
    ```

6. Перейдите на "http://localhost/phpmyadmin/". Введите логин и пароль (обычно это: root и mysql).
    - создайте новую базу данных с названием "petsdb" и кодировкой "utf8mb4_unicode_ci".
    - выволните к этой базе данных следующий SQL запрос:
    ```sql
    CREATE TABLE Services (
    ServiceID INT AUTO_INCREMENT PRIMARY KEY,
    ServicePrice DECIMAL(10,2) NOT NULL DEFAULT 0,
    ServiceName NVARCHAR(100) NOT NULL
    );

    CREATE TABLE Doctors (
    DoctorID INT AUTO_INCREMENT PRIMARY KEY,
    DoctorName NVARCHAR(100) NOT NULL
    );

    CREATE TABLE Appointment (
    AppointmentID INT AUTO_INCREMENT PRIMARY KEY,
    AppointmentFIO NVARCHAR(50) NOT NULL,
    AppointmentEmail NVARCHAR(50) NOT NULL,
    ServiceID INT,
    DoctorID INT,
    AppointmentDate DATE NOT NULL,
    AppointmentTime TIME NOT NULL,
    FOREIGN KEY (ServiceID) REFERENCES Services(ServiceID),
    FOREIGN KEY (DoctorID) REFERENCES Doctors(DoctorID)
    );


    INSERT INTO Services (ServicePrice, ServiceName)
    VALUES 
    (50.00, 'Консультация педиатра '),
    (70.00, 'Консультация хирурга'),
    (20.00, 'Стрижка ногтей'),
    (90.00, 'Лечебный массаж'),
    (20.00, 'Стрижка шерсти'),
    (50.00, 'Вакцинация кошек'),
    (50.00, 'Вакцинация грызунов'),
    (20.00, 'Обработка ран'),
    (70.00, 'Кастрирование'),
    (20.00, 'Стерилизация'),
    (100.00, 'Чипирование собак'),
    (100.00, 'Чипирование кошек');

    INSERT INTO Doctors (DoctorName)
    VALUES 
    ('Doctor 1'),
    ('Doctor 2'),
    ('Doctor 3'),
    ('Doctor 4'),
    ('Doctor 5'),
    ('Doctor 6'),
    ('Doctor 7'),;

    INSERT INTO Appointment (AppointmentFIO, AppointmentEmail, ServiceID, DoctorID, AppointmentDate, AppointmentTime)
    VALUES 
    ('Human', 'human@gmail.com', 1, 1, '2023-05-15', '12:00:00');
    ```
7. Перенесите папку "www" в корневой путь Ampps (пример: "C:\Program Files\Ampps\www").
    - для редактирования кода:
        - откройте Visual Studio Code > открыть папку > выберите папку "www".
## Возможности

1. Для пользователя:
* Возможность записи на приём
2. Для администратора:
* Полноценная работа с базой данных клиники ("http://localhost/TailsAndPaws/admin.php")
