<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwiftSkies - Process Booking</title>
</head>

<body>
    <h1>Flight Search Results</h1>

    <?php
    // Ελέγχουμε αν έχουν υποβληθεί τα δεδομένα από τη φόρμα
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Λαμβάνουμε τα δεδομένα από τη φόρμα
        $from = $_POST["from"];
        $to = $_POST["to"];
        $departing = $_POST["departing"];
        $returning = $_POST["returning"];
        $adults = $_POST["adults"];
        $children = $_POST["children"];
        $travel_class = $_POST["travel-class"];

        // Εκτύπωση των δεδομένων
        echo "<p>You searched for flights from $from to $to departing on $departing and returning on $returning.</p>";
        echo "<p>Number of adults: $adults</p>";
        echo "<p>Number of children: $children</p>";
        echo "<p>Travel class: $travel_class</p>";
    } else {
        // Αν δεν έχουν υποβληθεί δεδομένα, εμφανίζουμε ένα μήνυμα λάθους
        echo "<p>No data submitted.</p>";
    }
    ?>
</body>

</html>
