<?php
// Κώδικας PHP για τη σύνδεση στη βάση δεδομένων και την επεξεργασία δεδομένων
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swiftskies";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO flights (id, FLIGHTNUM, ORIGIN, DEST, DATE, ARR_TIME, DEP_TIME, AIRPLANE_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("sssssss", $_POST["id"], $_POST["flightNum"], $_POST["origin"], $_POST["destination"], $_POST["date"], $_POST["arrTime"], $_POST["depTime"], $_POST["airplane_id"]);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Information</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS for modal -->
    <style>
        /* Custom styles for the modal */
        .modal-header {
            background-color: #2A2185;
            color: white;
        }

        /* Padding for the main content */
        .main {
            padding: 20px;
        }

        /* Padding for the table */
        table {
            margin-top: 20px;
        }

        /* No padding for certain containers */
        .padding_zero {
            padding: 0;
        }

        /* Hamburger menu styles */
        .hamburger {
            display: none;
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 1001; /* Ensure it's on top of the sidebar */
        }

        .hamburger div {
            width: 30px;
            height: 3px;
            background-color: #ffffff;
            margin: 6px 0;
        }

        /* Sidebar styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #2A2185;
            transition: all 0.3s ease;
            z-index: 1000; /* Ensure it's below the hamburger menu */
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
                    <!-- Add Staff Button -->
                    <button type="button" class="btn btn-primary" style="background-color: #2A2185;" data-bs-toggle="modal"
                        data-bs-target="#addFlightModal">
                        Add Flight
                    </button>
                </div>
                <div class="table-responsive">
                    <!-- Staff Table -->
                    <table class="table">
                        <!-- Table Header -->
                        <thead>
                            <tr>
                                <th>NUM</th>
                                <th>FLIGHTNUM</th>
                                <th>ORIGIN</th>
                                <th>DEST</th>
                                <th>DATE</th>
                                <th>ARR-TIME</th>
                                <th>DEP-TIME</th>
                                <th>AIRPLANE_ID</th>
                            </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            <?php
                            // Εκτέλεση ερωτήματος SQL για την ανάκτηση των δεδομένων
                            $sql = "SELECT * FROM flights";
                            $result = $conn->query($sql);

                            // Έλεγχος αν υπάρχουν δεδομένα
                            if ($result->num_rows > 0) {
                                // Εμφάνιση κάθε γραμμής δεδομένων ως σειρά στον πίνακα
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".(isset($row["id"]) ? $row["id"] : "")."</td>";
                                    echo "<td>".$row["FLIGHTNUM"]."</td>";
                                    echo "<td>".$row["ORIGIN"]."</td>";
                                    echo "<td>".$row["DEST"]."</td>";
                                    echo "<td>".$row["DATE"]."</td>";
                                    echo "<td>".(isset($row["ARR_TIME"]) ? $row["ARR_TIME"] : "")."</td>";
                                    echo "<td>".(isset($row["DEP_TIME"]) ? $row["DEP_TIME"] : "")."</td>";
                                    echo "<td>".$row["AIRPLANE_ID"]."</td>";
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

        <!-- Add Staff Modal -->
        <!-- CHANGE AIRPLANE TO FLIGHT -->
        <div class="modal fade" id="addFlightModal" tabindex="-1" aria-labelledby="addFlightModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFlightModalLabel">Add New Flight</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Εδώ μπορείτε να προσθέσετε τα πεδία εισαγωγής για τα στοιχεία του εργαζόμενου -->
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

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function () {
            // Χειρισμός υποβολής της φόρμας
            $("#addFlightForm").submit(function (event) {
                event.preventDefault(); // Αποτροπή προεπιλεγμένης συμπεριφοράς φόρμας
                var formData = $(this).serialize(); // Παίρνουμε τα δεδομένα της φόρμας
                $.ajax({
                    type: "POST", // Μέθοδος HTTP
                    url: "add_flight.php", // Η διεύθυνση URL για την επεξεργασία της φόρμας
                    data: formData, // Τα δεδομένα που θα σταλούν
                    success: function(response) {
                        $('#addFlightModal').modal('hide'); // Κλείσιμο του modal
                        $('#addFlightForm')[0].reset(); // Επαναφορά της φόρμας
                        // Εδώ μπορείτε να κάνετε οποιαδήποτε άλλη ενέργεια χρειάζεται μετά την υποβολή
                    },
                    error: function(xhr, status, error) {
                        // Χειρισμός σφαλμάτων
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