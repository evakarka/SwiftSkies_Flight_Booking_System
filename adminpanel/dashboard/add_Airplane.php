<?php
// Σύνδεση στη βάση δεδομένων
$servername = "localhost";
$username = "root"; // Το όνομα χρήστη της βάσης δεδομένων
$password = ""; // Ο κωδικός πρόσβασης της βάσης δεδομένων
$dbname = "swiftskies"; // Το όνομα της βάσης δεδομένων

// Δημιουργία σύνδεσης
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Επεξεργασία δεδομένων μόνο αν είναι POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Αποφυγή SQL injection με τη χρήση παραμέτρων δέσμευσης (?)
    $sql = "INSERT INTO airplanes (SERNUM, MANUFACTURER, MODEL, AIRPLANE_ID) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Έλεγχος αν η προετοιμασία ερωτήματος απέτυχε
    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    // Συνδέουμε τις παράμετρους με τις μεταβλητές της φόρμας
    $stmt->bind_param("ssss", $_POST["SERNUM"], $_POST["MANUFACTURER"], $_POST["MODEL"], $_POST["AIRPLANE_ID"]);

    // Εκτέλεση του ερωτήματος
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Κλείσιμο της προετοιμασμένης δήλωσης
    $stmt->close();
}

// Κλείσιμο της σύνδεσης
$conn->close();
?>
