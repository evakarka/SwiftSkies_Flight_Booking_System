<?php
// Ενεργοποίηση της αναφοράς σφαλμάτων για αποσφαλμάτωση
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Σύνδεση στη βάση δεδομένων
$conn = new mysqli('localhost', 'root', '', 'swiftskies');

// Έλεγχος για σφάλματα σύνδεσης
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    // Προετοιμασία της SQL δήλωσης
    $sql = "SELECT * FROM users WHERE role = 'admin'";

    // Εκτέλεση της δήλωσης και έλεγχος για σφάλματα
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Εκτύπωση των εγγραφών όπως επιθυμείτε
        while ($row = $result->fetch_assoc()) {
            echo "Username: " . $row["username"]. " - Email: " . $row["email"]. "<br>";
            // Μπορείτε να εκτυπώσετε και άλλα πεδία ανάλογα με τις ανάγκες σας
        }
    } else {
        echo "Δεν βρέθηκαν εγγραφές";
    }

    // Κλείσιμο της σύνδεσης
    $conn->close();
}
?>
