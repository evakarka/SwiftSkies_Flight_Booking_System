<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "swiftskies"; 

$surname = $_POST['surname']; 
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Passenger (SURNAME, NAME, ADDRESS, PHONE) VALUES ('$surname', '$name', '$address', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
