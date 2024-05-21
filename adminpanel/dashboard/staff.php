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
    $empnum = $_POST["EMPNUM"] ?? '';
    $surname = $_POST["SURNAME"] ?? '';
    $name = $_POST["NAME"] ?? '';
    $address = $_POST["ADDRESS"] ?? '';
    $phone = $_POST["PHONE"] ?? '';
    $salary = $_POST["SALARY"] ?? '';

    $sql = "INSERT INTO staff (EMPNUM, SURNAME, NAME, ADDRESS, PHONE, SALARY) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $empnum, $surname, $name, $address, $phone, $salary);

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
    <title>Staff Information</title>
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

    <!-- Main Content -->
    <div class="details">
        <div class="container">
            <h2>Staff Information</h2>
            <div class="text-end">
                <button type="button" class="btn btn-primary" style="background-color: #2A2185;" data-bs-toggle="modal"
                    data-bs-target="#addStaffModal">
                    Add Staff
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>EMPNUM</th>
                            <th>SURNAME</th>
                            <th>NAME</th>
                            <th>ADDRESS</th>
                            <th>PHONE</th>
                            <th>SALARY</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM staff";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".htmlspecialchars($row["EMPNUM"])."</td>";
                                    echo "<td>".htmlspecialchars($row["SURNAME"])."</td>";
                                    echo "<td>".htmlspecialchars($row["NAME"])."</td>";
                                    echo "<td>".htmlspecialchars($row["ADDRESS"])."</td>";
                                    echo "<td>".htmlspecialchars($row["PHONE"])."</td>";
                                    echo "<td>".htmlspecialchars($row["SALARY"])."</td>";
                                    echo "<td><a href='#' class='update-btn' data-bs-toggle='modal' data-bs-target='#updateAirplaneModal'><i class='fas fa-edit'></i></a></td>";
                                    echo "<td><a href='#' class='delete-btn' data-bs-toggle='modal' data-bs-target='#deleteAirplaneModal'><i class='fas fa-trash-alt'></i></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No results found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStaffModalLabel">Add New Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStaffForm">
                        <div class="mb-3">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="text" class="form-control" id="surname" name="SURNAME">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="NAME">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="ADDRESS">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="PHONE">
                        </div>
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="text" class="form-control" id="salary" name="SALARY">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
    $(document).ready(function () {
        // Form submission handling
        $("#addStaffForm").submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "add_staff.php", 
                data: formData,
                success: function(response) {
                    $('#addStaffModal').modal('hide');
                    $('#addStaffForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


<script>
    // DELETE
    $(document).ready(function () {

    $(".delete-btn").click(function () {
        var airplaneId = $(this).closest("tr").find("td:eq(0)").text(); 
        $("#confirmDelete").attr("data-id", StaffId); 
    });

    $("#confirmDelete").click(function () {
        var airplaneId = $(this).attr("data-id"); 
        $.ajax({
            type: "POST", 
            url: "delete_Staff.php", 
            data: { id: airplaneId }, 
            success: function (response) {
                $('#deleteStaffModal').modal('hide'); 
            },
            error: function (xhr, status, error) {

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
</body>

</html>
