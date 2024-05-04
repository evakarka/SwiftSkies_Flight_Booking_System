<?php
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'swiftskies');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashedPasswordFromDB = $row['password'];

            // Ελέγχος του κωδικού πρόσβασης
            if (password_verify($password, $hashedPasswordFromDB)) {
                // Ο κωδικός πρόσβασης είναι σωστός
                // Πραγματοποιήστε τη σύνδεση του χρήστη
                echo "Login Successful.";
            } else {
                // Λανθασμένος κωδικός πρόσβασης
                echo "Incorrect password.";
            }
        } else {
            // Δεν βρέθηκε χρήστης με αυτό το email
            echo "User not found.";
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Please fill out all the fields in the form.";
}
?>
