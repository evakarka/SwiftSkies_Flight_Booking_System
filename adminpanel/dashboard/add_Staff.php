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
