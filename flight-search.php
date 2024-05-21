<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Information</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .flight-box {
            background: #f9fafb;
            border: 1px solid #e1e4e8;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            position: relative;
            transition: transform 0.3s;
        }

        .flight-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .flight-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .flight-header img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            border-radius: 50%;
        }

        .flight-header .airline-name {
            margin: 0;
            color: #333;
            font-size: 1.2em;
            flex-grow: 1; /* Allow the airline name to take up remaining space */
        }

        .flight-box p {
            margin: 8px 0;
            color: #666;
            font-size: 0.9em;
        }

        .flight-box h3 {
            margin: 12px 0 8px;
            color: #333;
        }

        .flight-box button {
            background: #ff6b6b;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            right: 20px;
            transition: background 0.3s;
        }

        .flight-box button:hover {
            background: #ff5252;
        }

        .flight-box .price {
            color: #ff6600;
            font-weight: bold;
        }

        .departure-return {
            text-align: right;
        }

        .departure-name {
            text-align: left;
        }

        @media (max-width: 600px) {
            .container {
                width: 95%;
            }

            .flight-box button {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Available Flights</h1>
    <?php
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "swiftskies";  // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture form data
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $departing = $_POST['departing'];
    $returning = isset($_POST['returning']) ? $_POST['returning'] : null;

    // SQL query to fetch filtered flight data
    $sql = "SELECT id, FLIGHTNUM, ORIGIN, DEST, DATE, ARR_TIME, DEP_TIME, AIRPLANE_ID, price, image, AIRLINE_NAME 
            FROM addflights 
            WHERE ORIGIN = ? AND DEST = ? AND DATE = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $flying_from, $flying_to, $departing);

    // Execute statement
    $stmt->execute();
    $result = $stmt->get_result();
    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        while($flight = $result->fetch_assoc()) {
            echo "<div class='flight-box' id='flight-{$flight['id']}'>";
            echo "<div class='flight-header'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($flight['image']) . "' alt='{$flight['AIRLINE_NAME']}'>";
            echo "<h2 class='airline-name'>{$flight['AIRLINE_NAME']}</h2>";
            echo "</div>";
            echo "<br>";
            echo "<h3 class='departure-return'>Departure</h3>";
            echo "<p><strong>Flight ID:</strong> {$flight['FLIGHTNUM']}</p>";
            echo "<p><strong>Price:</strong> <span class='price'>\${$flight['price']}</span></p>";
            echo "<p><strong>Flying From:</strong> {$flight['ORIGIN']}</p>";
            echo "<p><strong>Flying To:</strong> {$flight['DEST']}</p>";
            echo "<p><strong>Departure Time:</strong> {$flight['DATE']} {$flight['DEP_TIME']}</p>";

            // SQL query to fetch return flight data
            $return_sql = "SELECT FLIGHTNUM, ORIGIN, DEST, DATE, ARR_TIME, DEP_TIME, AIRPLANE_ID, price, image, AIRLINE_NAME 
                            FROM addflights 
                            WHERE ORIGIN = '{$flight['DEST']}' AND DEST = '{$flight['ORIGIN']}' AND DATE = '{$flight['DATE']}'";
            $return_result = $conn->query($return_sql);

            // Check if there are any return flights
            if ($return_result->num_rows > 0) {
                echo "<h3 class='departure-return'>Return</h3>";
                // Output data of the return flight
                while ($return_flight = $return_result->fetch_assoc()) {
                    echo "<p><strong>Flying From:</strong> {$return_flight['DEST']}</p>";
                    echo "<p><strong>Flying To:</strong> {$return_flight['ORIGIN']}</p>";
                    echo "<p><strong>Return Time:</strong> {$return_flight['DATE']} {$return_flight['ARR_TIME']}</p>";
                    echo "<p><strong>Flight ID (Return):</strong> {$return_flight['FLIGHTNUM']}</p>";
                    echo "<p><strong>Price (Return):</strong> <span class='price'>\${$return_flight['price']}</span></p>";
                }
            } else {
                // If no direct return flight found, check for indirect return flights
                $indirect_return_sql = "SELECT FLIGHTNUM, ORIGIN, DEST, DATE, ARR_TIME, DEP_TIME, AIRPLANE_ID, price, image, AIRLINE_NAME 
                                        FROM addflights 
                                        WHERE ORIGIN = '{$flight['DEST']}' AND DEST = '{$flight['ORIGIN']}'";

                $indirect_return_result = $conn->query($indirect_return_sql);

                if ($indirect_return_result->num_rows > 0) {
                    echo "<h3 class='departure-return'>Return</h3>";
                    // Output data of the indirect return flight
                    while ($indirect_return_flight = $indirect_return_result->fetch_assoc()) {
                        echo "<img src='data:image/jpeg;base64," . base64_encode($indirect_return_flight['image']) . "' alt='{$indirect_return_flight['AIRLINE_NAME']}' style='width: 40px; height: 40px; border-radius: 50%;'>";
                        echo "<h2 class='airline-name'>{$indirect_return_flight['AIRLINE_NAME']}</h2>";
                        echo "<p><strong>Flight ID:</strong> {$indirect_return_flight['FLIGHTNUM']}</p>";
                        echo "<p><strong>Price:</strong> <span class='price'>\${$indirect_return_flight['price']}</span></p>";
                        echo "<p><strong>Flying From:</strong> {$indirect_return_flight['DEST']}</p>";
                        echo "<p><strong>Flying To:</strong> {$indirect_return_flight['ORIGIN']}</p>";
                        echo "<p><strong>Return Time:</strong> {$indirect_return_flight['DATE']} {$indirect_return_flight['ARR_TIME']}</p>";
                    }
                } else {
                    echo "<p>No return flights found.</p>";
                }
            }
            echo "<button class='book-button' onclick='redirectToPay()'><i class='fas fa-ticket-alt'></i> Book Now</button>";
            echo "</div>"; // Close flight-box div
        }
        // Close connection
        $conn->close();
    } else {
        echo "No flights found.";
    }
    ?>
</div>

<script>
    function redirectToPay() {
        window.location.href = "bookingticket.php";
    }
</script>
</body>
</html>
