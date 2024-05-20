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