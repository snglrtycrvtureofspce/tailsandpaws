<?php
// Check if the doctor ID is provided
if (isset($_GET['id'])) {
    $doctorID = $_GET['id'];

    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'petsdb';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the doctor record from the database
    $sql = "SELECT * FROM Doctors WHERE DoctorID = $doctorID";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $doctorName = $row['DoctorName'];
    } else {
        echo "Doctor not found.";
        exit;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
    exit;
}
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Редактировать врача - Зоомир</title>
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
    <!-- Add your HTML content here for the edit doctor page -->

    <div class="container">
        <h2>Редактировать врача</h2>
        <form method="post" action="update_doctor.php">
            <div class="form-group">
                <label for="doctorID">Doctor ID:</label>
                <input type="text" class="form-control" id="doctorID" name="doctorID" value="<?php echo $doctorID; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="doctorName">Doctor Name:</label>
                <input type="text" class="form-control" id="doctorName" name="doctorName" value="<?php echo $doctorName; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
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