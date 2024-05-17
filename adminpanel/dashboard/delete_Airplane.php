<?php
// Σύνδεση με τη βάση δεδομένων
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swiftskies";

$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Έλεγχος εάν έχει σταλεί το αίτημα μέσω POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Εάν έχει σταλεί το ID του αεροσκάφους για διαγραφή
    if(isset($_POST['id']) && !empty($_POST['id'])) {
        $airplaneId = $_POST['id'];

        // Εκτέλεση ερωτήματος διαγραφής
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

// Κλείσιμο σύνδεσης με τη βάση δεδομένων
$conn->close();
?>
