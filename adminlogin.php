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
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2A2185;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #002144;
            padding: 40px; 
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        h2 {
            color: #FF4081;
        }

        label {
            color: #FFFFFF;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #FFFFFF;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #FF4081;
            color: #FFFFFF;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #D81B60;
        }
    </style>
</head>
<body>
<div class="login-container">
        <h2>Admin Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
