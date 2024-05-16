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
        /* Custom styles for the modal */
    .modal-header {
        background-color: #2A2185;
        color: white;
    }

    /* Περιθώρια για τον κεντρικό περιεχόμενο */
    .main {
        padding: 20px;
    }

    /* Περιθώρια για τον πίνακα */
    table {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
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

    <!-- Κεντρικό περιεχόμενο -->
    <div class="main">
        <div class="container">
            <h2>Staff Information</h2>
            <div class="text-end">
                <!-- Κουμπί προσθήκης με διακριτικό id για τη σύνδεση με το modal -->
                <button type="button" class="btn btn-primary" style="background-color: #2A2185;" data-bs-toggle="modal"
                    data-bs-target="#addStaffModal">
                    Add Staff
                </button>
            </div>
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
                    <!-- Υπόλοιπος κώδικας πίνακα εδώ... -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStaffModalLabel">Add New Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Εδώ μπορείτε να προσθέσετε τα πεδία εισαγωγής για τα στοιχεία του εργαζόμενου -->
                    <form id="addStaffForm">
                        <div class="mb-3">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            // Όταν η φόρμα υποβάλλεται
            $("#addStaffForm").submit(function (event) {
                // Αποτροπή της προεπιλεγμένης συμπεριφοράς φόρμας υποβολής
                event.preventDefault();
                
                // Ανάκτηση των δεδομένων από τη φόρμα
                var formData = $(this).serialize();

                // Αποστολή δεδομένων φόρμας μέσω AJAX
                $.ajax({
                    type: "POST",
                    url: "add_staff.php", // Το αρχείο PHP που θα διαχειριστεί την εισαγωγή στη βάση δεδομένων
                    data: formData,
                    success: function(response) {
                        // Κλείσιμο του modal
                        $('#addStaffModal').modal('hide');
                        // Επαναφορά της φόρμας
                        $('#addStaffForm')[0].reset();
                        // Ανανέωση των δεδομένων στον πίνακα
                        // Προσαρμόστε τον κώδικα ανάλογα με το πώς ανανεώνετε τα δεδομένα του πίνακα
                    }
                });
            });
        });
    </script>
    <script src="assets/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
