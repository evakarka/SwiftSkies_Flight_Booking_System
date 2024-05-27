<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "swiftskies";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select database
$conn->select_db($database);

// Create users table
$sqlCreateUsersTable = "CREATE TABLE IF NOT EXISTS signup (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'pilot', 'staff', 'purser') NOT NULL,
    approved BOOLEAN DEFAULT FALSE
)";

if ($conn->query($sqlCreateUsersTable) !== TRUE) {
    echo "Error creating users table: " . $conn->error . "<br>";
}

$message = "";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['approve'])){
        $userId = $_POST['user_id'];
        $sqlApproveUser = "UPDATE signup SET approved = TRUE WHERE id = $userId";
        if ($conn->query($sqlApproveUser) === TRUE) {
            $message = "User approved successfully";
        } else {
            $message = "Error approving user: " . $conn->error;
        }
    }
    if(isset($_POST['delete'])){
        $userId = $_POST['user_id'];
        $sqlDeleteUser = "DELETE FROM signup WHERE id = $userId";
        if ($conn->query($sqlDeleteUser) === TRUE) {
            $message = "User deleted successfully";
        } else {
            $message = "Error deleting user: " . $conn->error;
        }
    }
}

// Fetch unapproved users
$sqlFetchUsers = "SELECT * FROM signup WHERE approved = FALSE";
$result = $conn->query($sqlFetchUsers);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Information</title>
    <link rel="shortcut icon" href="assets/imgs/aircraft-logo.png" type="image/svg+xml">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-header { background-color: #2A2185; color: white; }
        .main { padding: 20px; }
        table { margin-top: 20px; }
        .padding_zero { padding: 0; }
        .hamburger { display: none; position: absolute; top: 20px; right: 20px; cursor: pointer; z-index: 1001; }
        .hamburger div { width: 30px; height: 3px; background-color: #ffffff; margin: 6px 0; }
        .sidebar { height: 100%; width: 250px; position: fixed; top: 0; left: -250px; background-color: #2A2185; transition: all 0.3s ease; z-index: 1000; }
        .sidebar a { display: block; padding: 15px; color: #ffffff; text-decoration: none; }

        .table-responsive {
            margin-top: 20px;
        }
        th, td {
            text-align: center;
        }
        .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .btn-primary {
            background-color: #2A2185;
            border-color: #2A2185;
        }
        .btn-primary:hover {
            background-color: #1a1449;
            border-color: #1a1449;
        }
        .modal-header {
            background-color: #2A2185;
            color: white;
        }
        .modal-content {
            border-radius: 0.3rem;
        }
        .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
        }
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #2A2185;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
<!-- Notification -->
<div class="notification" id="notification">
    <?php echo $message; ?>
</div>
<!-- Navigation -->
<div class="container-fluid padding_zero">
        <div class="navigation">
        <div class="hamburger" id="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <ul>
                <li>
                    <a href="./index.html">
                        <span class="icon">
                            <img src="assets/imgs/logo.png" alt="logo" style="height: 30px;">
                        </span>
                        <span class="title">SwiftSkies</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="passengers.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Passengers</span>
                    </a>
                </li>

                <li>
                    <a href="flights.php">
                        <span class="icon">
                            <ion-icon name="airplane-outline"></ion-icon>
                        </span>
                        <span class="title">Flights</span>
                    </a>
                </li>

                <li>
                    <a href="airplanes.php">
                        <span class="icon">
                            <ion-icon name="airplane-outline" style="transform: rotate(-45deg);"></ion-icon>
                        </span>
                        <span class="title">Airplanes</span>
                    </a>
                </li>

                <li>
                    <a href="staff.php">
                        <span class="icon">
                            <ion-icon name="person-outline">></ion-icon>
                        </span>
                        <span class="title">Staff</span>
                    </a>
                </li>

                <li>
                    <a href="city.php">
                        <span class="icon">
                            <ion-icon name="globe-outline">></ion-icon>
                        </span>
                        <span class="title">City</span>
                    </a>
                </li>

                <li>
                    <a href="register.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Panel</span>
                    </a>
                </li>

                <li>
                    <a href="help.php">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>

                <li>
                    <a href="setting.php">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="password.php">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li>
                    <a href="signout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

<!-- Main Content -->
<div class="main">
    <h1>Admin Panel</h1>
    <h2>Unapproved Users</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['fullName'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td>
                                <form method='post'>
                                    <input type='hidden' name='user_id' value='" . $row['id'] . "'>
                                    <button type='submit' name='approve' class='btn btn-primary'>Approve</button>
                                    <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No unapproved users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>



<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@ionic/core@5.9.1/dist/ionic/ionic.esm.js" type="module"></script>
<script src="https://cdn.jsdelivr.net/npm/@ionic/core@5.9.1/dist/ionic/ionic.js" nomodule></script>
<script src="assets/js/script.js"></script>
</body>
</html>
<?php
// Close connection
$conn->close();
?>
