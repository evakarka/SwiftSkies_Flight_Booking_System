<?php
if(!empty($_POST['fullName']) && !empty($_POST['email']) && !empty($_POST['role']) && !empty($_POST['phone'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];

    $conn = new mysqli('localhost', 'root', '', 'swiftskies');

    if($conn->connect_error){
        die('Connection Failed: '.$conn->connect_error);
    } else {
        if ($role === 'staff' || $role === 'pilot' || $role === 'purser') {
            $stmt = $conn->prepare("INSERT INTO admin_approval (fullName, email, phone, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fullName, $email, $phone, $role);
            $stmt->execute();
            echo "Your registration requires admin approval. Please wait for confirmation.";
            $stmt->close();
        } else {
            $stmt = $conn->prepare("INSERT INTO registration (fullName, email, phone, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fullName, $email, $phone, $role);
            $stmt->execute();
            echo "Registration Successfully...";
            $stmt->close();
        }
        $conn->close();

        // Ανακατεύθυνση στην αρχική σελίδα μετά την επιτυχή εγγραφή
        header("Location: index.html");
        exit();
    }
} else {
    echo "Please fill out all the fields in the form.";
}
?>
