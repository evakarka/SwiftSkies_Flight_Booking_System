<?php
// Ενεργοποίηση της αναφοράς σφαλμάτων για αποσφαλμάτωση
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Έλεγχος αν όλα τα απαιτούμενα δεδομένα POST είναι ορισμένα
    if (isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['role'])) {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Κρυπτογράφηση του κωδικού πρόσβασης
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Σύνδεση στη βάση δεδομένων
        $conn = new mysqli('localhost', 'root', '', 'swiftskies');

        // Έλεγχος για σφάλματα σύνδεσης
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        } else {
            // Προετοιμασία της SQL δήλωσης
            $stmt = $conn->prepare("INSERT INTO signup (fullName, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $fullName, $email, $phone, $hashedPassword, $role);

            // Εκτέλεση της δήλωσης και έλεγχος για σφάλματα
            if ($stmt->execute()) {
                echo "Successful registration";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Κλείσιμο της δήλωσης και της σύνδεσης
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "Όλα τα πεδία είναι υποχρεωτικά.";
    }
}
?>


<!-- <script>
    window.location.href = "index.html";
</script> -->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styleloginandregister.css" />
    <title>Sign in & Sign up Form</title>

    <style>
      .input-field select {
  appearance: none;
  -moz-appearance: none;
  -webkit-appearance: none;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  width: 100%;
  font-size: 16px;
  font-family: 'Poppins', sans-serif; 
  color: #ccc; 
  font-weight: bold;
  cursor: pointer;
}

.input-field select option {
  background-color: #f0f0f0;
  font-weight: bold;
  color: #ccc;
}

    </style>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <!-- login -->
<!-- login -->
<form action="#" class="sign-in-form" method="POST" id="login-form">
    <h2 class="title">Sign in</h2>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="email" name="email" id="login-email" placeholder="Email" aria-label="Email" />
    </div>
    <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="login-password" placeholder="Password" aria-label="Password" />
    </div>
    <a href="forgot-password.php" class="text-body">Forgot password?</a>
    <input type="submit" value="Login" class="btn solid" />
    <a href="adminlogin.php" style="text-decoration: none;">Sign in as admin</a>
    <p class="social-text">Or Sign in with social platforms</p>
    <div class="social-media">
        <a href="#" class="social-icon">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="social-icon">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="social-icon">
            <i class="fab fa-google"></i>
        </a>
        <a href="#" class="social-icon">
            <i class="fab fa-instagram"></i>
        </a>
    </div>
</form>

          <!-- sign up -->
          <form action="" method="POST" class="sign-up-form">
    <h2 class="title">Sign up</h2>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" id="fullName" class="form-control form-control-lg" placeholder="Full Name" name="fullName" aria-label="Full Name">
    </div>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="tel" id="phone" class="form-control form-control-lg" placeholder="Phone" name="phone" aria-label="Phone">
    </div>
    <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input type="email" id="email" class="form-control form-control-lg" placeholder="Email" name="email" aria-label="Email">
    </div>
    <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" id="password" class="form-control form-control-lg" placeholder="Password" name="password" aria-label="Password">
    </div>
    <div class="input-field">
    <i class="fas fa-lock"></i>
    <select id="role" class="form-control form-control-lg custom-dropdown" name="role" aria-label="Role">
        <option value="user">User</option>
        <option value="pilot">Pilot</option>
        <option value="staff">Staff</option>
        <option value="purser">Purser</option>
    </select>
</div>

    <input type="submit" class="btn" value="Sign up" />
</form>


        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
            Welcome to SwiftSkies! Whether you're a frequent traveler or embarking on your first journey, we're here to make your experience unforgettable.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/travel.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
            Are you ready to join the SwiftSkies family? Discover seamless travel experiences and personalized service with us.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/departing.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script>
      const sign_in_btn = document.querySelector("#sign-in-btn");
      const sign_up_btn = document.querySelector("#sign-up-btn");
      const container = document.querySelector(".container");

      sign_up_btn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
      });

      sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
      });

    </script>

<script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Αποτροπή της προεπιλεγμένης συμπεριφοράς υποβολής φόρμας

        // Παίρνουμε τις τιμές των πεδίων email και password
        var email = document.getElementById('login-email').value;
        var password = document.getElementById('login-password').value;

        // Κάνουμε fetch τον PHP κώδικα για να ελέγξουμε τα διαπιστευτήρια του χρήστη
        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password),
        })
        .then(response => response.text())
        .then(data => {
            // Εμφανίζουμε το μήνυμα ανάλογα με την απάντηση του PHP κώδικα
            if (data.trim() === 'Successful login') {
              alert(data); // Εδώ μπορείτε να χρησιμοποιήσετε μια πιο κατάλληλη αντίδραση, όπως η μεταφορά στην index.html
                window.location.href = "index.html"; // Μεταφορά στην index.html μετά από επιτυχημένη σύνδεση
            } else {
                alert(data); // Εμφάνιση μηνύματος λάθους από τον PHP κώδικα
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
  </body>
</html>
