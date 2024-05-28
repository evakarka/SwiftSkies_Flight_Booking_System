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

    if(isset($_POST['id']) && !empty($_POST['id'])) {
        $airplaneId = $_POST['id'];

        $sql = "DELETE FROM airplanes WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error: " . $conn->error);
        }

        $stmt->bind_param("i", $airplaneId);

        if ($stmt->execute()) {
            echo "Airplane deleted successfully";
        } else {
            echo "Error deleting airplane: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Error: No airplane ID provided for deletion";
    }
} else {
    echo "Error: Invalid request method";
}

$conn->close();
?>
