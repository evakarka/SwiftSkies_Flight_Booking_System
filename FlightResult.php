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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $from = $_POST["from"];
        $to = $_POST["to"];
        $departing = $_POST["departing"];
        $returning = $_POST["returning"];
        $adults = $_POST["adults"];
        $children = $_POST["children"];
        $travel_class = $_POST["travel-class"];

        echo "<p>You searched for flights from $from to $to departing on $departing and returning on $returning.</p>";
        echo "<p>Number of adults: $adults</p>";
        echo "<p>Number of children: $children</p>";
        echo "<p>Travel class: $travel_class</p>";
    } else {
        echo "<p>No data submitted.</p>";
    }
    ?>
</body>

</html>
