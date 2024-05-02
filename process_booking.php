<?php

// Σύνδεση στη βάση δεδομένων
$servername = "localhost";
$username = "root"; // Όνομα χρήστη root
$password = ""; // Κωδικός πρόσβασης (αφήστε κενό αν δεν έχετε ορίσει κωδικό)
$dbname = "swiftskies"; // Όνομα της βάσης δεδομένων

// Παίρνουμε τα δεδομένα από την υποβολή της φόρμας
$surname = $_POST['surname']; // Προσαρμόστε το 'surname' ανάλογα με το όνομα του πεδίου στη φόρμα
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// Δημιουργία σύνδεσης
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Εισαγωγή δεδομένων στη βάση δεδομένων
$sql = "INSERT INTO Passenger (SURNAME, NAME, ADDRESS, PHONE) VALUES ('$surname', '$name', '$address', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Κλείσιμο σύνδεσης
$conn->close();

?>
