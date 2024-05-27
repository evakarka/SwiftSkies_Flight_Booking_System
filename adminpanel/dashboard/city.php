<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swiftskies";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["CITY_ID"]) && isset($_POST["CITY_NAME"])) {
        $sql = "INSERT INTO city (CITY_ID, CITY_NAME) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error: " . $conn->error);
        }

        $stmt->bind_param("ss", $_POST["CITY_ID"], $_POST["CITY_NAME"]);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Required fields are missing.";
    }
}

// Βεβαιωθείτε ότι η σύνδεση κλείνει στο τέλος
// Η HTML/JS εκτέλεση βρίσκεται εδώ
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Information</title>
    <link rel="shortcut icon" href="assets/imgs/aircraft-logo.png" type="image/svg+xml">
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS for modal -->
    <style>
        .modal-header {
            background-color: #2A2185;
            color: white;
        }

        .main {
            padding: 20px;
        }

        table {
            margin-top: 20px;
        }

        .padding_zero {
            padding: 0;
        }

        .hamburger {
            display: none;
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 1001; 
        }

        .hamburger div {
            width: 30px;
            height: 3px;
            background-color: #ffffff;
            margin: 6px 0;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #2A2185;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            color: #ffffff;
            text-decoration: none;
        }
    </style>
</head>

<body>
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
                    <a href="./index.php">
                        <span class="icon">
                            <img src="assets/imgs/logo.png" alt="logo" style="height: 30px;">
                        </span>
                        <span class="title">SwiftSkies</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
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

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <div class="user">
                <img src="assets/imgs/customer01.jpg" alt="">
            </div>
        </div>

        <!-- Main Content -->
        <div class="details">
            <div class="container">
                <h2>City Information</h2>
                <div class="text-end">
                    <!-- Add City Button -->
                    <button type="button" class="btn btn-primary" style="background-color: #2A2185;" data-bs-toggle="modal"
                        data-bs-target="#addCityModal">
                        Add City
                    </button>
                </div>
                <div class="table-responsive">
                    <!-- City Table -->
                    <table class="table">
                        <!-- Table Header -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>City ID</th>
                                <th>City Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM city";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>".$row["CITY_ID"]."</td>";
                                        echo "<td>".$row["CITY_NAME"]."</td>";
                                        echo "<td><a href='#' class='update-btn' data-bs-toggle='modal' data-bs-target='#updateCityModal'><i class='fas fa-edit'></i></a></td>";
                                        echo "<td><a href='#' class='delete-btn' data-bs-toggle='modal' data-bs-target='#deleteCityModal'><i class='fas fa-trash-alt'></i></a></td>";
                                        echo "</tr>";
                                    }                                
                                } else {
                                    echo "0 results";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add City Modal -->
        <div class="modal fade" id="addCityModal" tabindex="-1" aria-labelledby="addCityModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCityModalLabel">Add New City</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addCityForm">
                            <div class="mb-3">
                                <label for="CITY_ID" class="form-label">City ID</label>
                                <input type="text" class="form-control" id="CITY_ID" name="CITY_ID">
                            </div>
                            <div class="mb-3">
                                <label for="CITY_NAME" class="form-label">City Name</label>
                                <input type="text" class="form-control" id="CITY_NAME" name="CITY_NAME">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Custom JavaScript -->
        <script>
            $(document).ready(function () {
                // Form submission handling
                $("#addCityForm").submit(function (event) {
                    event.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: "add_City.php", // Change this to the appropriate URL for handling form submission
                        data: formData,
                        success: function(response) {
                            $('#addCityModal').modal('hide');
                            $('#addCityForm')[0].reset();
                            // Refresh table data or perform any other necessary actions
                            location.reload(); // Reload the page to see the new city
                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>

        <script src="assets/js/main.js"></script>
        <!-- Ionicons -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>

<?php
// Κλείσιμο της σύνδεσης
$conn->close();
?>
