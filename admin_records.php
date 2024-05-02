<?php
// Σύνδεση με τη βάση δεδομένων
$conn = new mysqli('localhost', 'root', '', 'swiftskies');

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Επιλογή εγγραφών ανάλογα με τον ρόλο
$sql = "SELECT * FROM registration WHERE role IN ('pilot', 'staff', 'purser') AND approved IS NULL";
$result = $conn->query($sql);

// Έλεγχος αποτελέσματος
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["surname"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td>";
        echo "<i class='fa-solid fa-circle-check' onclick='acceptRecord(" . $row["id"] . ")'></i> ";
        echo "<i class='fa-solid fa-circle-xmark' onclick='rejectRecord(" . $row["id"] . ")'></i>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

// Κλείσιμο σύνδεσης
$conn->close();
?>
