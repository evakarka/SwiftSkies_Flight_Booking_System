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
    $surname = isset($_POST["surname"]) ? $_POST["surname"] : "";
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";

    if (empty($surname) || empty($name) || empty($address) || empty($phone)) {
        echo "All fields are required.";
    } else {
        $sql = "INSERT INTO passengers (SURNAME, NAME, ADDRESS, PHONE) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $surname, $name, $address, $phone);

        if ($stmt->execute()) {
            header("Location: checkout.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
}

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
                            <input type='text' class='form-control' id='SURNAME' name='surname' required>
                        </div>
                        <div class='mb-3'>
                            <label for='NAME' class='form-label'>Name</label>
                            <input type='text' class='form-control' id='NAME' name='name' required>
                        </div>
                        <div class='mb-3'>
                            <label for='ADDRESS' class='form-label'>Address</label>
                            <input type='text' class='form-control' id='ADDRESS' name='address' required>
                        </div>
                        <div class='mb-3'>
                            <label for='PHONE' class='form-label'>Phone</label>
                            <input type='text' class='form-control' id='PHONE' name='phone' required>
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
