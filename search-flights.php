<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SwiftSkies - Search Flights</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/images/aircraft-logo.png" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">

      <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- jQuery UI library -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <style>
  </style>
</head>
<body>
<br>

<header class="header" data-header>

<div class="overlay" data-overlay></div>

<div class="header-top">
  <div class="container">

    <a href="tel:+01123456790" class="helpline-box">

      <div class="icon-box">
        <ion-icon name="call-outline"></ion-icon>
      </div>

      <div class="wrapper">
        <p class="helpline-title">For Further Inquires :</p>

        <p class="helpline-number">+ 30 690 000 00</p>
      </div>

    </a>

    <a href="#" class="logo">
      <img src="./assets/images/trace.svg" alt="Tourly logo">
    </a>

    <div class="header-btn-group">

      <button class="search-btn" aria-label="Search">
        <ion-icon name="search"></ion-icon>
      </button>

      <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

    </div>

  </div>
</div>

<div class="header-bottom">
  <div class="container">

    <ul class="social-list">

      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-facebook"></ion-icon>
        </a>
      </li>

      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-twitter"></ion-icon>
        </a>
      </li>

      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-youtube"></ion-icon>
        </a>
      </li>

    </ul>

    <nav class="navbar" data-navbar>

      <div class="navbar-top">

        <a href="#" class="logo">
          <img src="./assets/images/blue.svg" alt="logo">
        </a>
        

        <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>

      </div>

      <ul class="navbar-list">

        <li>
          <a href="#home" class="navbar-link" data-nav-link>home</a>
        </li>

        <li>
          <a href="#" class="navbar-link" data-nav-link>about us</a>
        </li>

        <li>
          <a href="#destination" class="navbar-link" data-nav-link>destination</a>
        </li>

        <li>
          <a href="#package" class="navbar-link" data-nav-link>packages</a>
        </li>

        <li>
          <a href="#gallery" class="navbar-link" data-nav-link>gallery</a>
        </li>

        <li>
          <a href="#contact" class="navbar-link" data-nav-link>contact us</a>
        </li>

        <li>
          <a href="#signup" class="navbar-link" data-nav-link>sign up</a>
        </li>

      </ul>

    </nav>

  </div>
</div>

</header>
<br><br>
    <!-- Flight Search Results -->
    <section class="container mt-5">
        <div class="row">
            <?php
 
            $servername = "localhost";
            $username = "root"; 
            $password = ""; 
            $dbname = "swiftskies"; 
 
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM flights";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-6">
                        <div class="card result-card">
                            <div class="card-body">
                                <div class="flight-details">
                                    <img src="img/logo.png" style="height: 60px;" alt="logo">
                                    <div>
                                        <h5 class="card-title"><?php echo isset($row['FLIGHTNUM']) ? $row['FLIGHTNUM'] : ''; ?></h5>
                                        <span class="flight-price">$<?php echo isset($row['price']) ? $row['price'] : ''; ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="flight-info">
                                    <p><?php echo isset($row['ORIGIN']) ? $row['ORIGIN'] : ''; ?></p>
                                    <i class="fa-solid fa-plane"></i>
                                    <p><?php echo isset($row['DEST']) ? $row['DEST'] : ''; ?></p>
                                </div>
                                <div class="flight-info">
                                    <p><?php echo isset($row['ARR_TIME']) ? $row['ARR_TIME'] : ''; ?></p>
                                    <p><?php echo isset($row['DEP_TIME']) ? $row['DEP_TIME'] : ''; ?></p>
                                </div>
                                <div class="flight-time">
                                    <?php
                                    $flight_duration = isset($row['flight_duration']) ? $row['flight_duration'] : '';

                                    if ($flight_duration != '') {
                                        $time_parts = explode(":", $flight_duration);
                                        $hours = $time_parts[0];
                                        $minutes = $time_parts[1];

                                        $total_minutes = $hours * 60 + $minutes;

                                        $total_hours = floor($total_minutes / 60);
                                        $remaining_minutes = $total_minutes % 60;

                                        echo "Total Flight Time: " . $total_hours . " hours " . $remaining_minutes . " minutes";
                                    }
                                    ?>
                                </div>
                                <button class="book-button" onclick="redirectToPay()">Book Now</button>

                                <script>
                                    function redirectToPay() {
                                        window.location.href = "bookingticket.php";
                                    }
                                </script>

                            </div>
                        </div>
                    </div>

                <?php
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </section>

    <script>
        window.onscroll = function() {stickNavbar()};
        
        const navbar = document.getElementById("navbar");
        const sticky = navbar.offsetTop;
        
        function stickNavbar() {
          if (window.pageYOffset > sticky) {
            navbar.classList.add("sticky");
          }
          else {
            navbar.classList.remove("sticky");
          }
        }
        
        const slides = document.querySelector('.slides');
        const slide = document.querySelectorAll('.slide');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        let index = 0;
        
        function showSlide(n) {
          index += n;
          if (index >= slide.length) {
            index = 0;
          }
          if (index < 0) {
            index = slide.length - 1;
          }
          slides.style.transform = 'translateX(' + (-index * 100) + '%)';
        }
        
        prevBtn.addEventListener('click', () => showSlide(-1));
        nextBtn.addEventListener('click', () => showSlide(1));
        
        const hamburger = document.getElementById("hamburger");
        const sidebar = document.getElementById("sidebar");
        const closebtn = document.getElementById("closebtn");
        
        hamburger.addEventListener("click", () => {
          sidebar.style.width = "250px";
        });
        
        closebtn.addEventListener("click", () => {
          sidebar.style.width = "0";
        });
    </script>
</body>
</html>
