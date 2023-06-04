<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Услуги</title>
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

   <style>
        
        table {
            border-collapse: collapse;
            margin: 0 auto;
            font-size: 24px;
            background-color: transparent;
        }
        
        td {
            padding: 18px;
            text-align: left;
            margin: 0 auto;
        }
        
        th {
            background-color: transparent;
            padding: 18px;
            text-align: left;
            margin: 0 auto;
        }
    </style>
</head>

<body>
   <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header_start  -->
    <header>
      <div class="header-area ">
          <div class="header-top_area">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-6 col-md-8">
                          <div class="short_contact_list">
                              <ul>
                                  <li><a href="#">+375291471034</a></li>
                                  <li><a href="#">Пн - Вс 10:00 - 21:00</a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-4 ">
                          <div class="social_media_links">
                          <a href="https://facebook.com/liza.tyan.3">
                                  <i class="fa fa-facebook"></i>
                              </a>
                              </a>
                              <a href="https://www.instagram.com/tailsandpawsclinic/">
                                  <i class="fa fa-instagram"></i>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div id="sticky-header" class="main-header-area">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-xl-3 col-lg-3">
                          <div class="logo">
                              <a href="index.html">
                                  <img src="img/logo.png" alt="">
                              </a>
                          </div>
                      </div>
                      <div class="col-xl-9 col-lg-9">
                          <div class="main-menu  d-none d-lg-block">
                              <nav>
                                 <ul class="links">
                                    <li><a href="index.html">Главная</a></li>
                                    <li><a href="about.html">О нас </a></li>
                                    <li><a href="contact.html">Контакты</a></li>
                                    <li><a href="zapiz.php">Запись на прием</a></li>
                                    <li><a href="uslugi.php">Услуги</a></li>
                                  </ul>
                              </nav>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="mobile_menu d-block d-lg-none"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </header>
  <!-- header_start  -->

  <!-- bradcam_area_start -->
  <div class="bradcam_area breadcam_bg">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bradcam_text text-center">
                      <h3>Услуги</h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- bradcam_area_end -->

   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
      <div class="container">
      <h3>Поиск по врачам</h3>
        <form action="search_copy.php" method="GET">
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
        <form action="search_service_copy.php" method="GET">
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
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="section_title">
                    <?php
                    // Подключение к базе данных и выполнение запроса
                    $servername = 'localhost'; // Имя сервера базы данных
                    $username = 'root'; // Имя пользователя базы данных
                    $password = 'mysql'; // Пароль базы данных
                    $dbname = 'petsdb'; // Имя базы данных
                
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Ошибка подключения: " . $conn->connect_error);
                    }
                
                    $sql = "SELECT ServicePrice, ServiceName FROM Services";
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        echo "<table>";
                        // Вывод заголовков
                        echo "<tr>
                                <th>Услуга</th>
                                <th>Цена</th>
                            </tr>";
                
                        // Вывод данных
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>".$row["ServiceName"]."</td>
                                    <td>".$row["ServicePrice"]."</td>
                                  </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Нет данных для отображения.";
                    }
                    $conn->close();
                    ?>
                    
                    </section>


                  </aside>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->

    <!-- footer_start  -->
    <footer class="footer">
      <div class="footer_top">
          <div class="container">
              <div class="row">
                  <div class="col-xl-3 col-md-6 col-lg-3">
                      <div class="footer_widget">
                        <h3 class="footer_title">
                           Свяжитесь С Нами
                       </h3>
                       <ul class="address_line">
                           <li>+375291471034</li>
                           <li><a href="#">Zoo@gmail.com</a></li>
                           <li>Долгобродская, 30. Минск</li>
                       </ul>
                   </div>
               </div>
               <div class="col-xl-3  col-md-6 col-lg-3">
                   <div class="footer_widget">
                       <h3 class="footer_title">
                           Cтраницы
                       </h3>
                       <ul class="links">
                           <li><a href="#">Главная</a></li>
                           <li><a href="#">О нас </a></li>
                           <li><a href="#">Контакты</a></li>
                           <li><a href="#">Запись на прием</a></li>
                       </ul>
                   </div>
               </div>
               <div class="col-xl-3  col-md-6 col-lg-3">
                   <div class="footer_widget">
                   </div>
               </div>
               <div class="col-xl-3 col-md-6 col-lg-3 ">
                   <div class="footer_widget">
                       <div class="footer_logo">
                           <a href="#">
                               <img src="img/logo.png" alt="">
                           </a>
                       </div>
                       <p class="address_text">Долгобродская 30. Минск. 
                          </p>
                          <div class="socail_links">
                              <ul>
                                  <li>
                                  <a href="https://facebook.com/liza.tyan.3">
                                          <i class="ti-facebook"></i>
                                      </a>
                                  </li>

                                  <li>
                                      <a href="https://www.instagram.com/tailsandpawsclinic/">
                                          <i class="fa fa-instagram"></i>
                                      </a>
                                  </li>

                              </ul>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>

                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- footer_end  -->


   <!-- JS here -->
   <script src="js/vendor/modernizr-3.5.0.min.js"></script>
   <script src="js/vendor/jquery-1.12.4.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/owl.carousel.min.js"></script>
   <script src="js/isotope.pkgd.min.js"></script>
   <script src="js/ajax-form.js"></script>
   <script src="js/waypoints.min.js"></script>
   <script src="js/jquery.counterup.min.js"></script>
   <script src="js/imagesloaded.pkgd.min.js"></script>
   <script src="js/scrollIt.js"></script>
   <script src="js/jquery.scrollUp.min.js"></script>
   <script src="js/wow.min.js"></script>
   <script src="js/nice-select.min.js"></script>
   <script src="js/jquery.slicknav.min.js"></script>
   <script src="js/jquery.magnific-popup.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/gijgo.min.js"></script>

   <!--contact js-->
   <script src="js/contact.js"></script>
   <script src="js/jquery.ajaxchimp.min.js"></script>
   <script src="js/jquery.form.js"></script>
   <script src="js/jquery.validate.min.js"></script>
   <script src="js/mail-script.js"></script>

   <script src="js/main.js"></script>
   <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            disableDaysOfWeek: [0, 0],
        //     icons: {
        //      rightIcon: '<span class="fa fa-caret-down"></span>'
        //  }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }

        });
        var timepicker = $('#timepicker').timepicker({
         format: 'HH.MM'
     });
   </script>
</body>

</html>