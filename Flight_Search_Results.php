<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background-image: linear-gradient(to bottom, #2A2185, #FFFFFF);
            font-family: Arial, sans-serif;
            color: #ffffff;
        }
        .result-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            color: #000;
        }
        .flight-logo {
            max-height: 50px;
        }
        .flight-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .flight-price {
            font-size: 1.5em;
            color: #FF4600;
        }
        .destination-image {
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
        .card-body {
            padding: 1.25rem;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
        }
        .card-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        .flight-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .flight-info p {
            margin-bottom: 0;
        }
        .flight-time {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: #6c757d;
        }
        .book-button {
            background-color: #2A2185;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .book-button:hover {
            background-color: #007bff;
        }
        .arrow {
            font-size: 1.25rem;
            color: #6c757d;
            margin: 0 5px;
        }
    </style>
</head>
<body>
<br>

<div class="navbar" id="navbar">
    <div class="logo">
      <a href="#" style="font-size: 20px;">DailyNewsChart</a>
    </div>
    <div class="nav-links" id="navLinks">
      <a href="index.html">Home</a>
      <a href="about.php">About</a>
      <a href="service.php">Services</a>
      <a href="contact.php">Contact</a>
    </div>
    <div class="hamburger" id="hamburger">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  
  <div id="sidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" id="closebtn">&times;</a>
    <a href="index.html">Home</a>
    <a href="about.php">About</a>
    <a href="#">Services</a>
    <a href="contact.php">Contact</a>
  </div>
  

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
                                <button class="book-button">Book Now</button>
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
