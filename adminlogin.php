<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "SwiftSkies";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Σύνδεση απέτυχε: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        header("Location: http://localhost/air//adminpanel/dashboard/index.html");
        exit();


    } else {
        echo "Wrong Password or Username!";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styleloginandregister.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Admin login -->
                <form action="adminlogin.php" method="POST" class="sign-in-form">
                    <h2 class="title">Admin Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" aria-label="Username" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" aria-label="Password" required>
                    </div>
                    <input type="submit" name="login" value="Login" class="btn solid">
                    <a href="index.html" style="text-decoration: none;">Back to Home</a>
                </form>

                <!-- Register new user (for testing purposes) -->
                <form action="adminlogin.php" method="POST" class="sign-up-form">
                    <h2 class="title">Register New Admin</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="new_username" placeholder="New Username" aria-label="New Username" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="new_password" placeholder="New Password" aria-label="New Password" required>
                    </div>
                    <input type="submit" name="register" value="Register" class="btn solid">
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Admin Access Only</h3>
                    <p>
                        Please enter your admin credentials to access the dashboard.
                    </p>
                </div>
                <img src="img/admin.svg" class="image" alt="">
            </div>
        </div>
    </div>

    <script>
        // Additional JavaScript if needed
    </script>
</body>
</html>
