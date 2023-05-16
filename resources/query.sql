CREATE DATABASE PetsDB;

USE PetsDB;

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
('Приходько Ксения Викторовна'),
('Данилкович Дана Сергеевна'),
('Данилкович Дана Сергеевна'),
('Яроцкий Артём Александрович'),
('Струсова Елизавета Юрьевна'),
('Воскресенкая Виктория Юрьевна'),
('Коржик Константин Сергеевич');

INSERT INTO Appointment (AppointmentFIO, AppointmentEmail, ServiceID, DoctorID, AppointmentDate, AppointmentTime)
VALUES 
('Шалькевич Елизавета Вадимовна', 'coiriel1@gmail.com', 1, 1, '2023-05-15', '12:00:00');