<?php
// Σύνδεση στη βάση δεδομένων
$servername = "localhost";
$username = "root"; // Το όνομα χρήστη της βάσης δεδομένων
$password = ""; // Ο κωδικός πρόσβασης της βάσης δεδομένων
$dbname = "swiftskies"; // Το όνομα της βάσης δεδομένων

// Δημιουργία σύνδεσης
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Εκτέλεση ερωτήματος SQL για την ανάκτηση των δεδομένων
$sql = "SELECT * FROM flights";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Information</title>
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
                    <a href="/index.html">
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
                    <a href="adminprofile.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Profile</span>
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

            <div class="details">
            <div class="container">
                <h2>Flights Information</h2>
                <div class="text-end">
                    <button type="button" class="btn btn-primary" style="background-color: #2A2185;" data-bs-toggle="modal"
                        data-bs-target="#addFlightModal">
                        Add Flight
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NUM</th>
                                <th>FLIGHTNUM</th>
                                <th>ORIGIN</th>
                                <th>DEST</th>
                                <th>DATE</th>
                                <th>ARR-TIME</th>
                                <th>DEP-TIME</th>
                                <th>price</th>
                                <th>AIRPLANE_ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . (isset($row["id"]) ? $row["id"] : "") . "</td>";
                                        echo "<td>" . $row["FLIGHTNUM"] . "</td>";
                                        echo "<td>" . $row["ORIGIN"] . "</td>";
                                        echo "<td>" . $row["DEST"] . "</td>";
                                        echo "<td>" . $row["DATE"] . "</td>";
                                        echo "<td>" . (isset($row["ARR_TIME"]) ? $row["ARR_TIME"] : "") . "</td>";
                                        echo "<td>" . (isset($row["DEP_TIME"]) ? $row["DEP_TIME"] : "") . "</td>";
                                        echo "<td>" . $row["price"] . "</td>";
                                        echo "<td>" . $row["AIRPLANE_ID"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "0 results";
                                }

                                $result->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addFlightModal" tabindex="-1" aria-labelledby="addFlightModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFlightModalLabel">Add New Flight</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addFlightForm" method="post" action="add_flight.php">
                            <div class="mb-3">
                                <label for="flightNum" class="form-label">Flight Number</label>
                                <input type="text" class="form-control"
                                id="flightNum" name="flightNum" required>
                            </div>
                            <div class="mb-3">
                                <label for="origin" class="form-label">Origin</label>
                                <input type="text" class="form-control" id="origin" name="origin">
                            </div>
                            <div class="mb-3">
                                <label for="destination" class="form-label">Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination">
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div class="mb-3">
                                <label for="arrTime" class="form-label">Arrival Time</label>
                                <input type="time" class="form-control" id="arrTime" name="arrTime">
                            </div>
                            <div class="mb-3">
                                <label for="depTime" class="form-label">Departure Time</label>
                                <input type="time" class="form-control" id="depTime" name="depTime">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                            <div class="mb-3">
                                <label for="airplane_id" class="form-label">Airplane ID</label>
                                <input type="text" class="form-control" id="airplane_id" name="airplane_id">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#addFlightForm").submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize(); 
                $.ajax({
                    type: "POST", 
                    url: "add_flight.php", 
                    data: formData, 
                    success: function(response) {
                        $('#addFlightModal').modal('hide'); 
                        $('#addFlightForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="assets/js/main.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>