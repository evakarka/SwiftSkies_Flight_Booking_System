<?php
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$role = $_POST['role']; // Προσθέσαμε αυτήν τη γραμμή για να λάβουμε τον ρόλο του χρήστη από τη φόρμα

$conn = new mysqli('localhost', 'root', '', 'swiftskies');

if($conn->connect_error){
    die('Connection Failed: '.$conn->connect_error);
} else {
    // Έλεγχος του ρόλου του χρήστη
    if ($role === 'user' || $role === 'passenger') {
        // Αν ο ρόλος είναι user ή passenger, εισάγουμε κατευθείαν στη βάση δεδομένων
        $stmt = $conn->prepare("INSERT INTO registration (fullName, email, phone, gender, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullName, $email, $phone, $gender, $role);
        $stmt->execute();
        echo "Registration Successfully...";
        $stmt->close();
    } else {
        // Αν ο ρόλος είναι staff, pilot ή purser, προσθέτουμε τον χρήστη σε πίνακα που θα διαχειρίζεται ο διαχειριστής
        $stmt = $conn->prepare("INSERT INTO admin_approval (fullName, email, phone, gender, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullName, $email, $phone, $gender, $role);
        $stmt->execute();
        echo "Your registration requires admin approval. Please wait for confirmation.";
        $stmt->close();
    }
    $conn->close();
}
?>
