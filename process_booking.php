<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Results</title>
    <!-- Include any necessary CSS stylesheets here -->
</head>
<body>

<?php
// Εδώ μπορείς να πάρεις τα δεδομένα από τη φόρμα
// Παράδειγμα:
$from = $_POST['from'];
$to = $_POST['to'];
$departing = $_POST['departing'];
$returning = $_POST['returning'];
$adults = $_POST['adults'];
$children = $_POST['children'];
$travel_class = $_POST['travel-class'];

// Τώρα μπορείς να χρησιμοποιήσεις αυτά τα δεδομένα για να αναζητήσεις τις πτήσεις από τη βάση δεδομένων ή άλλη πηγή

// Στο παράδειγμα αυτό, απλώς θα εμφανίσουμε μερικές στατικές πτήσεις ως παράδειγμα
$flights = array(
    array("destination" => "London", "price" => "$200"),
    array("destination" => "Paris", "price" => "$250"),
    array("destination" => "New York", "price" => "$500")
);

// Εμφανίζουμε τα αποτελέσματα
echo "<h2>Flight Results</h2>";
echo "<p>Showing flights from $from to $to departing on $departing and returning on $returning for $adults adults and $children children in $travel_class class:</p>";

echo "<ul>";
foreach ($flights as $flight) {
    echo "<li>Destination: " . $flight['destination'] . " - Price: " . $flight['price'] . "</li>";
}
echo "</ul>";
?>

</body>
</html>
