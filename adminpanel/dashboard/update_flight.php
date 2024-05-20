<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $flightNum = $_POST['flightNum'];
    $airline_name = $_POST['airline_name'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $arrTime = $_POST['arrTime'];
    $depTime = $_POST['depTime'];
    $price = $_POST['price'];
    $airplane_id = $_POST['airplane_id'];

    // Σύνδεση στη βάση δεδομένων
    $conn = new mysqli('localhost', 'username', 'password', 'database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ενημέρωση της πτήσης
    $sql = "UPDATE flights SET FLIGHTNUM=?, AIRLINE_NAME=?, ORIGIN=?, DEST=?, DATE=?, ARR_TIME=?, DEP_TIME=?, PRICE=?, AIRPLANE_ID=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssiii', $flightNum, $airline_name, $origin, $destination, $date, $arrTime, $depTime, $price, $airplane_id, $id);

    if ($stmt->execute()) {
        echo "Flight updated successfully.";
    } else {
        echo "Error updating flight: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
