<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "swiftskies";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

// Check if user is admin
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'admin') {
    die("Access denied.");
}

// Handle admin actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $action = $_POST['action'];

    if ($action === 'approve' || $action === 'deny') {
        $status = ($action === 'approve') ? 'approved' : 'denied';

        // Prepare SQL statement
        $stmt = $conn->prepare("UPDATE signup SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $userId);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "User $action successful.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } elseif ($action === 'delete') {
        // Prepare SQL statement
        $stmt = $conn->prepare("DELETE FROM signup WHERE id = ?");
        $stmt->bind_param("i", $userId);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "User deletion successful.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Fetch pending registrations
$result = $conn->query("SELECT id, fullName, email, role FROM signup WHERE role IN ('pilot', 'staff', 'purser') AND status = 'pending'");

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Pending Registrations</h2>
    <table border="1">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['fullName']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td>
                <form action="admin_dashboard.php" method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="action" value="approve">
                    <input type="submit" value="Approve">
                </form>
                <form action="admin_dashboard.php" method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="action" value="deny">
                    <input type="submit" value="Deny">
                </form>
                <form action="admin_dashboard.php" method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="action" value="delete">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
