<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <table border="1">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
        <?php
            // Σύνδεση με τη βάση δεδομένων και επιλογή εκκρεμών εγγραφών
            $conn = new mysqli('localhost', 'root', '', 'swiftskies');
            $sql = "SELECT * FROM registration WHERE approved IS NULL";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Εμφάνιση των εγγραφών προς επεξεργασία
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["fullName"]."</td>";
                    echo "<td>".$row["email"]."</td>";
                    echo "<td>".$row["phone"]."</td>";
                    echo "<td>".$row["gender"]."</td>";
                    echo "<td><a href='approve.php?id=".$row["id"]."'>Approve</a> | <a href='reject.php?id=".$row["id"]."'>Reject</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            $conn->close();
        ?>
    </table>
</body>
</html>
