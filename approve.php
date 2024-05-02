<?php
// Σύνδεση με τη βάση δεδομένων
$conn = new mysqli('localhost', 'root', '', 'swiftskies');

// Έλεγχος σύνδεσης
if($conn->connect_error) {
    die('Connection Failed: '.$conn->connect_error);
}

// Παίρνουμε το ID της εγγραφής που εγκρίθηκε από το URL
$id = $_GET['id'];

// Ενημέρωση του πεδίου "approved" σε 1 για το συγκεκριμένο ID
$sql = "UPDATE registration SET approved = 1 WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record approved successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// Κλείσιμο σύνδεσης με τη βάση δεδομένων
$conn->close();

// Ανακατεύθυνση πίσω στον admin panel
header("Location: admin_panel.php");
exit();
?>
