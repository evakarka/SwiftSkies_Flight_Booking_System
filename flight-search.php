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
        $flights = [
            [
                "flightId" => "FL123",
                "airline" => "Airways X",
                "airlineImage" => "https://scontent.fath6-1.fna.fbcdn.net/v/t39.30808-6/245329908_10161476255433782_6455420918677781425_n.jpg?_nc_cat=1&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFz3-DIlH_qoq6J2kb0EagEfrT3ENzUHBl-tPcQ3NQcGdNTtvHY68X2A0SW08Uw52Qcwi-JlxIhZ3ns3jIMNocf&_nc_ohc=8fuTbAHtM0gQ7kNvgHiP8tq&_nc_ht=scontent.fath6-1.fna&oh=00_AYBqi0Hc7YS2fQBzEsoeQg5VQf16Rz8-gUXlSEAZ7LKCYw&oe=66526BB2",
                "price" => "$300",
                "departure" => "New York",
                "arrival" => "Los Angeles",
                "departureTime" => "2024-05-25 14:30",
                "returnTime" => "2024-05-30 16:00"
            ],
            [
                "flightId" => "FL456",
                "airline" => "Airways Y",
                "airlineImage" => "https://scontent.fath6-1.fna.fbcdn.net/v/t39.30808-6/245329908_10161476255433782_6455420918677781425_n.jpg?_nc_cat=1&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFz3-DIlH_qoq6J2kb0EagEfrT3ENzUHBl-tPcQ3NQcGdNTtvHY68X2A0SW08Uw52Qcwi-JlxIhZ3ns3jIMNocf&_nc_ohc=8fuTbAHtM0gQ7kNvgHiP8tq&_nc_ht=scontent.fath6-1.fna&oh=00_AYBqi0Hc7YS2fQBzEsoeQg5VQf16Rz8-gUXlSEAZ7LKCYw&oe=66526BB2",
                "price" => "$400",
                "departure" => "San Francisco",
                "arrival" => "Chicago",
                "departureTime" => "2024-06-10 09:00",
                "returnTime" => "2024-06-15 11:30"
            ],
            [
                "flightId" => "FL789",
                "airline" => "Airways Z",
                "airlineImage" => "https://scontent.fath6-1.fna.fbcdn.net/v/t39.30808-6/245329908_10161476255433782_6455420918677781425_n.jpg?_nc_cat=1&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFz3-DIlH_qoq6J2kb0EagEfrT3ENzUHBl-tPcQ3NQcGdNTtvHY68X2A0SW08Uw52Qcwi-JlxIhZ3ns3jIMNocf&_nc_ohc=8fuTbAHtM0gQ7kNvgHiP8tq&_nc_ht=scontent.fath6-1.fna&oh=00_AYBqi0Hc7YS2fQBzEsoeQg5VQf16Rz8-gUXlSEAZ7LKCYw&oe=66526BB2",
                "price" => "$350",
                "departure" => "Miami",
                "arrival" => "Dallas",
                "departureTime" => "2024-07-01 08:00",
                "returnTime" => "2024-07-07 10:00"
            ]
        ];

        foreach ($flights as $index => $flight) {
            echo "<div class='flight-box' id='flight-$index'>";
            echo "<div class='flight-header'>";
            echo "<img src='{$flight['airlineImage']}' alt='{$flight['airline']}'>";
            echo "<h2 class='airline-name'>{$flight['airline']}</h2>"; // Airline name aligned left
            echo "</div>";
            echo "<p><strong>Flight ID:</strong> {$flight['flightId']}</p>";
            echo "<p><strong>Price:</strong> <span class='price'>{$flight['price']}</span></p>";
            echo "<h3 class='departure-return'>Departure</h3>";
            echo "<p><strong>Flying From:</strong> {$flight['departure']}</p>";
            echo "<p><strong>Flying To:</strong> {$flight['arrival']}</p>";
            echo "<p><strong>Departure Time:</strong> {$flight['departureTime']}</p>";
            echo "<h3 class='departure-return'>Return</h3>";
            echo "<p><strong>Flying From:</strong> {$flight['arrival']}</p>";
            echo "<p><strong>Flying To:</strong> {$flight['departure']}</p>";
            echo "<p><strong>Return Time:</strong> {$flight['returnTime']}</p>";
            echo "<button onclick='closeFlight($index)'>Close</button>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        function closeFlight(index) {
            document.getElementById('flight-' + index).remove();
        }
    </script>
</body>
</html>
