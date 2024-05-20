<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required POST data is set
    if (isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['role'])) {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'swiftskies');

        // Check for connection errors
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO signup (fullName, email, phone, gender, password, role) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $fullName, $email, $phone, $gender, $hashedPassword, $role);

            // Execute the statement and check for errors
            if ($stmt->execute()) {
                echo "Registration Successfully...";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "All fields are required.";
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
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <!-- login -->
          <form action="#" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" aria-label="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" aria-label="Password" />
            </div>
            <a href="forgot-password.php" class="text-body">Forgot password?</a>
            <input type="submit" value="Login" class="btn solid" />
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
                <i class="fab fa-linkedin-in"></i>
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
        <i class="fas fa-user"></i>
        <input type="text" id="gender" class="form-control form-control-lg" placeholder="Gender" name="gender" aria-label="Gender">
    </div>
    <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="text" id="role" class="form-control form-control-lg" placeholder="Role" name="role" aria-label="Role">
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
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
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
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
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
  </body>
</html>
