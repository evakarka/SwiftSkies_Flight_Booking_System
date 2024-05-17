<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Information Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2A2185;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #2A2185;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1A1465;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .success {
            color: green;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Passenger Information Form</h2>
        <form action="checkout.php" method="POST">
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <!-- <label for="card_method">Payment Method:</label>
            <select id="card_method" name="card_method" required>
                <option value="visa">Visa</option>
                <option value="mastercard">Mastercard</option>
                <option value="amex">American Express</option>
            </select>

            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>

            <label for="expiration_date">Expiration Date:</label>
            <input type="text" id="expiration_date" name="expiration_date" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required> -->

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
