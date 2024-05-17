<?php
$servername = "localhost";
$username = "root"; 
$dbname = "swiftskies"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO airplanes (SERNUM, MANUFACTURER, MODEL, AIRPLANE_ID) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("ssss", $_POST["SERNUM"], $_POST["MANUFACTURER"], $_POST["MODEL"], $_POST["AIRPLANE_ID"]);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
