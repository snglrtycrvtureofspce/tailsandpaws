<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Appointment - Зоомир</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Place favicon.ico in the root directory -->

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
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!-- Add your HTML content here for the edit appointment page -->
    <div class="container">
        <h2>Edit Appointment</h2>

        <?php
        // Check if the appointment ID is provided
        if (isset($_GET['id'])) {
            $appointmentID = $_GET['id'];

            // Database connection
            $servername = 'localhost';
            $username = 'root';
            $password = 'mysql';
            $dbname = 'petsdb';

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve the appointment details from the database
            $sql = "SELECT * FROM Appointment WHERE AppointmentID = $appointmentID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $appointmentFIO = $row["AppointmentFIO"];
                $appointmentEmail = $row["AppointmentEmail"];
                $serviceID = $row["ServiceID"];
                $doctorID = $row["DoctorID"];
                $appointmentDate = $row["AppointmentDate"];
                $appointmentTime = $row["AppointmentTime"];
        ?>

                <form method="POST" action="update_appointment.php">
                    <input type="hidden" name="appointmentID" value="<?php echo $appointmentID; ?>">
                    <div class="form-group">
                        <label for="appointmentFIO">Full Name:</label>
                        <input type="text" class="form-control" id="appointmentFIO" name="appointmentFIO" value="<?php echo $appointmentFIO; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="appointmentEmail">Email:</label>
                        <input type="email" class="form-control" id="appointmentEmail" name="appointmentEmail" value="<?php echo $appointmentEmail; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="serviceID">Service:</label>
                        <select class="form-control" id="serviceID" name="serviceID" required>
                            <?php
                            // Retrieve the services from the database
                            $sql = "SELECT * FROM Services";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $selected = ($row["ServiceID"] == $serviceID) ? "selected" : "";
                                    echo "<option value='" . $row["ServiceID"] . "' " . $selected . ">" . $row["ServiceName"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="doctorID">Doctor:</label>
                        <select class="form-control" id="doctorID" name="doctorID" required>
                            <?php
                            // Retrieve the doctors from the database
                            $sql = "SELECT * FROM Doctors";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $selected = ($row["DoctorID"] == $doctorID) ? "selected" : "";
                                    echo "<option value='" . $row["DoctorID"] . "' " . $selected . ">" . $row["DoctorName"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="appointmentDate">Date:</label>
                        <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" value="<?php echo $appointmentDate; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="appointmentTime">Time:</label>
                        <input type="time" class="form-control" id="appointmentTime" name="appointmentTime" value="<?php echo $appointmentTime; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

        <?php
            } else {
                echo "Appointment not found.";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "Invalid request.";
        }
        ?>

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
    <scriptsrc="js /jquery.countdown.min.js">
        </scriptsrc=>
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