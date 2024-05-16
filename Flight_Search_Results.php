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
            // Σύνδεση με τη βάση δεδομένων
            $servername = "localhost";
            $username = "root"; // Το όνομα χρήστη της βάσης
            $password = ""; // Ο κωδικός πρόσβασης της βάσης
            $dbname = "swiftskies"; // Το όνομα της βάσης δεδομένων
    
            // Δημιουργία σύνδεσης
            $conn = new mysqli($servername, $username, $password, $dbname);
    
            // Έλεγχος σύνδεσης
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            // Ερώτημα προς τη βάση δεδομένων
            $sql = "SELECT * FROM flight";
            $result = $conn->query($sql);
    
            // Έλεγχος αποτελεσμάτων
            if ($result->num_rows > 0) {
                // Εκτύπωση δεδομένων για κάθε πτήση
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-6">
                        <div class="card result-card">
                            <div class="card-body">
                                <div class="flight-details">
                                    <img src="<?php echo $row['logo']; ?>" alt="Airline Logo" class="flight-logo">
                                    <div>
                                        <h5 class="card-title"><?php echo $row['flight_number']; ?></h5>
                                        <span class="flight-price">$<?php echo $row['price']; ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="flight-info">
                                    <p><?php echo $row['departure']; ?></p>
                                    <i class="fa-solid fa-plane"></i>
                                    <p><?php echo $row['destination']; ?></p>
                                </div>
                                <div class="flight-info">
                                    <p><?php echo $row['departure_time']; ?></p>
                                    <p><?php echo $row['arrival_time']; ?></p>
                                </div>
                                <div class="flight-time">
                                    <p>Total Flight Time: <?php echo $row['flight_duration']; ?> hours</p>
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
          } else {
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
