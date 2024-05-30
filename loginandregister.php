<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "swiftskies";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

// Check if action is set in the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // Handle registration
    if ($action == 'signup') {
        if (isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['role'])) {
            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // Encrypt the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Set approved status based on role
            $approved = ($role === 'user') ? true : false;

            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO signup (fullName, email, phone, password, role, approved) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $fullName, $email, $phone, $hashedPassword, $role, $approved);

            // Execute the statement and check for errors
            if ($stmt->execute()) {
                if ($approved) {
                    echo "Successful registration";
                } else {
                    echo "Registration successful. Your account needs to be approved by an admin before you can log in.";
                }
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "All fields are required.";
        }
    }
    // Handle login
    elseif ($action == 'login') {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Prepare SQL statement to fetch user
            $stmt = $conn->prepare("SELECT password, approved FROM signup WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashedPassword, $approved);
                $stmt->fetch();

                // Verify the password
                if (password_verify($password, $hashedPassword)) {
                    if ($approved) {
                        // Set session variable
                        $_SESSION['user_email'] = $email;
                        // Redirect to index.html
                        header("Location: index.html");
                        exit();
                    } else {
                        echo "Your account needs to be approved by an admin before you can log in.";
                    }
                } else {
                    echo "Wrong Password or Username!";
                }
            } else {
                echo "Wrong Password or Username!";
            }

            // Close statement
            $stmt->close();
        } else {
            echo "All fields are required.";
        }
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="assets/imgs/aircraft-logo.png" type="image/svg+xml">
    <link rel="stylesheet" href="css/styleloginandregister.css">
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
                <form action="loginandregister.php" class="sign-in-form" method="POST">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" placeholder="Email" aria-label="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" aria-label="Password" required />
                    </div>
                    <input type="hidden" name="action" value="login">
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
                <form action="loginandregister.php" method="POST" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="fullName" placeholder="Full Name" aria-label="Full Name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="phone" placeholder="Phone" aria-label="Phone" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" aria-label="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" aria-label="Password" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user-tag"></i>
                        <select name="role" aria-label="Role" required>
                            <option value="user">User</option>
                            <option value="pilot">Pilot</option>
                            <option value="staff">Staff</option>
                            <option value="purser">Purser</option>
                        </select>
                    </div>
                    <input type="hidden" name="action" value="signup">
                    <input type="submit" class="btn" value="Sign up" />
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>Welcome to SwiftSkies! Whether you're a frequent traveler or embarking on your first journey, we're here to make your experience unforgettable.</p>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="img/travel.svg" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>Are you ready to join the SwiftSkies family? Discover seamless travel experiences and personalized service with us.</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="img/departing.svg" class="image" alt="">
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
