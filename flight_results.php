<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Flight Search Results</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Flight</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Υποκατάλογος πτήσεων (υποκατάλογος μόνο για επίδειξη)
                $flights = array(
                    array("Flight 1", "ATH", "AMS", "Apr 5", "Apr 8", "$277.99"),
                    array("Flight 2", "ATH", "AUH", "Apr 22", "Apr 30", "$1,030.99"),
                    array("Flight 3", "ATH", "PRG", "May 15", "May 19", "$189.99"),
                    array("Flight 4", "ATH", "OTP", "Mar 16", "Mar 21", "$279.99"),
                    array("Flight 5", "ATH", "CDG", "Mar 2", "Mar 6", "$289.99"),
                    array("Flight 6", "ATH", "OSL", "Apr 15", "Apr 22", "$654.99"),
                    array("Flight 7", "ATH", "MAD", "Jun 3", "Jun 7", "$325.99"),
                    array("Flight 8", "ATH", "FCO", "Jul 10", "Jul 15", "$129.99"),
                    array("Flight 9", "ATH", "ARN", "Aug 5", "Aug 11", "$429.99")
                );

                // Εμφάνιση των αποτελεσμάτων
                foreach ($flights as $flight) {
                    echo "<tr>";
                    echo "<td>{$flight[0]}</td>";
                    echo "<td>{$flight[1]} - {$flight[2]} <br> {$flight[3]} - {$flight[4]}</td>";
                    echo "<td>{$flight[5]}</td>";
                    echo "<td>{$flight[6]}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
