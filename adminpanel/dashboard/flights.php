<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swiftskies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO addflights (FLIGHTNUM, ORIGIN, DEST, DATE, ARR_TIME, DEP_TIME, AIRPLANE_ID, PRICE, image, AIRLINE_NAME) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $imageData = null;
    }

    // Prepare data for insertion
    $flightNum = $_POST["flightNum"] ?? null;
    $origin = $_POST["origin"] ?? null;
    $destination = $_POST["destination"] ?? null;
    $date = $_POST["date"] ?? null;
    $arrTime = $_POST["arrTime"] ?? null;
    $depTime = $_POST["depTime"] ?? null;
    $airplane_id = $_POST["airplane_id"] ?? null;
    $price = $_POST["PRICE"] ?? null;
    $airline_name = $_POST["airline_name"] ?? null;

    $stmt->bind_param("sssssssssb", $flightNum, $origin, $destination, $date, $arrTime, $depTime, $airplane_id, $PRICE, $imageData, $airline_name);

    if ($stmt->execute()) {
        echo "New Flight created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM addflights";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Information</title>
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
                    <button type="button" class="btn btn-primary" style="background-color: #2A2185;" data-bs-toggle="modal" data-bs-target="#addFlightModal">
                        Add Flight
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NUM</th>
                                <th>IMAGE</th>
                                <th>AIRLINE_NAME</th>
                                <th>FLIGHTNUM</th>
                                <th>ORIGIN</th>
                                <th>DEST</th>
                                <th>DATE</th>
                                <th>ARR-TIME</th>
                                <th>DEP-TIME</th>
                                <th>PRICE</th>
                                <th>AIRPLANE_ID</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($result) && $result !== null) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . (isset($row["id"]) ? $row["id"] : "") . "</td>";
                                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Flight Image' style='width: 40px; height: auto;'/></td>";
                                        echo "<td>" . $row["AIRLINE_NAME"] . "</td>";
                                        echo "<td>" . $row["FLIGHTNUM"] . "</td>";
                                        echo "<td>" . $row["ORIGIN"] . "</td>";
                                        echo "<td>" . $row["DEST"] . "</td>";
                                        echo "<td>" . $row["DATE"] . "</td>";
                                        echo "<td>" . (isset($row["ARR_TIME"]) ? $row["ARR_TIME"] : "") . "</td>";
                                        echo "<td>" . (isset($row["DEP_TIME"]) ? $row["DEP_TIME"] : "") . "</td>";
                                        echo "<td>" . (isset($row["PRICE"]) ? $row["PRICE"] : "") . "</td>";
                                        echo "<td>" . $row["AIRPLANE_ID"] . "</td>";
                                        echo "<td>";
                                        echo "<button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#updateFlightModal' data-id='" . $row["id"] . "'><ion-icon name='create-outline'></ion-icon></button> ";
                                        echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteFlight(" . $row["id"] . ")'><ion-icon name='trash-outline'></ion-icon></button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='12'>0 results</td></tr>";
                                }
                                $result->close();
                            } else {
                                echo "<tr><td colspan='12'>No results found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Flight Modal -->
        <div class="modal fade" id="addFlightModal" tabindex="-1" aria-labelledby="addFlightModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFlightModalLabel">Add New Flight</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addFlightForm" method="post" action="add_flight.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="flightNum" class="form-label">Flight Number</label>
                                <input type="text" class="form-control" id="flightNum" name="flightNum" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg">
                            </div>
                            <div class="mb-3">
                                <label for="airline_name" class="form-label">Airline Name</label>
                                <input type="text" class="form-control" id="airline_name" name="airline_name">
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

<!-- Update Flight Modal -->
<div class="modal fade" id="updateFlightModal" tabindex="-1" aria-labelledby="updateFlightModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateFlightModalLabel">Update Flight</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateFlightForm" method="post" action="update_flight.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="flightNum" class="form-label">Flight Number</label>
                    <input type="text" class="form-control" id="flightNum" name="flightNum" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg">
                    </div>
                    <div class="mb-3">
                        <label for="airline_name" class="form-label">Airline Name</label>
                        <input type="text" class="form-control" id="airline_name" name="airline_name">
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


        <script>
            $(document).ready(function () {
                // Handle form submissions for adding and updating flights...
            });

            function deleteFlight(id) {
                if (confirm('Are you sure you want to delete this flight?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'delete_flight.php',
                        data: { id: id },
                        success: function(response) {
                            alert('Flight deleted successfully.');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="scripts.js"></script>
    </div>
    
</body>
</html>