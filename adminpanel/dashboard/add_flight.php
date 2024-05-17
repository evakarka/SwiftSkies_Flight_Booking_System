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
        $sql = "INSERT INTO flights (FLIGHTNUM, ORIGIN, DEST, DATE, ARR_TIME, DEP_TIME, AIRPLANE_ID) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("sssssss", $_POST["flightNum"], $_POST["origin"], $_POST["destination"], $_POST["date"], $_POST["arrTime"], $_POST["depTime"], $_POST["airplane_id"]);

    if ($stmt->execute()) {
        echo "New Flight created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
