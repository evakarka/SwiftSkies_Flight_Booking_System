<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $flightType = $_POST['flight-type'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $departing = $_POST['departing'];
    $returning = $_POST['returning'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $travelClass = $_POST['travel-class'];

    // You can process the booking data here, e.g., save to database, send confirmation email, etc.

    // For demonstration purpose, let's just display the submitted data
    echo "<h2>Booking Details</h2>";
    echo "<p>Flight Type: $flightType</p>";
    echo "<p>From: $from</p>";
    echo "<p>To: $to</p>";
    echo "<p>Departing: $departing</p>";
    echo "<p>Returning: $returning</p>";
    echo "<p>Adults: $adults</p>";
    echo "<p>Children: $children</p>";
    echo "<p>Travel Class: $travelClass</p>";
} else {
    // If the form is not submitted, redirect back to the form page
    header("Location: index.php");
    exit;
}
?>
