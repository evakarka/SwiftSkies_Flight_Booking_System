<?php
// Σύνδεση με τη βάση δεδομένων
$conn = new mysqli('localhost', 'root', '', 'swiftskies');

// Έλεγχος σύνδεσης
if($conn->connect_error) {
    die('Connection Failed: '.$conn->connect_error);
}

// Παίρνουμε το ID της εγγραφής που απορρίφθηκε από το URL
$id = $_GET['id'];

// Διαγραφή της συγκεκριμένης εγγραφής από τον πίνακα
$sql = "DELETE FROM registration WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record rejected successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Κλείσιμο σύνδεσης με τη βάση δεδομένων
$conn->close();

// Ανακατεύθυνση πίσω στον admin panel
header("Location: admin_panel.php");
exit();
?>
