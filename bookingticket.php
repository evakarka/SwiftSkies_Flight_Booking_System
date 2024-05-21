<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swiftskies";

// Σύνδεση στη βάση δεδομένων
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Έλεγχος αν έχουν υποβληθεί δεδομένα από τη φόρμα POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Λήψη δεδομένων από τη φόρμα
    $surname = $_POST["SURNAME"];
    $name = $_POST["NAME"];
    $address = $_POST["ADDRESS"];
    $phone = $_POST["PHONE"];

    // Εισαγωγή δεδομένων στη βάση δεδομένων με προετοιμασμένα ερωτήματα
    $sql = "INSERT INTO passengers (SURNAME, NAME, ADDRESS, PHONE) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $surname, $name, $address, $phone);

    if ($stmt->execute()) {
        // Αν η εισαγωγή είναι επιτυχής, προχωρήστε στο checkout.php
        header("Location: checkout.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}

// Κλείσιμο σύνδεσης με τη βάση δεδομένων
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Booking Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .form-container {
            margin-top: 50px;
        }
        .card {
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

<section class="container form-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-4">Passenger Booking Details</h2>
                    <form action="" method="POST">
                        <div class='mb-3'>
                            <label for='SURNAME' class='form-label'>Surname</label>
                            <input type='text' class='form-control' id='SURNAME' name='SURNAME' required>
                        </div>
                        <div class='mb-3'>
                            <label for='NAME' class='form-label'>Name</label>
                            <input type='text' class='form-control' id='NAME' name='NAME' required>
                        </div>
                        <div class='mb-3'>
                            <label for='ADDRESS' class='form-label'>Address</label>
                            <input type='text' class='form-control' id='ADDRESS' name='ADDRESS' required>
                        </div>
                        <div class='mb-3'>
                            <label for='PHONE' class='form-label'>Phone</label>
                            <input type='text' class='form-control' id='PHONE' name='PHONE' required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
