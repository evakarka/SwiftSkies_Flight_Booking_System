<?php

require_once __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PHGknFkiVHNe1mtTXNwkJyfpBRq3RSM9oBIs7qVgI4BK9ZxbMpA1pnChsz30RxghkmbIDF26SAnO6m0I1P4h3tf00y6YtJfgM";
// Ρυθμίζουμε το κλειδί πρόσβασης του Stripe API
\Stripe\Stripe::setApiKey($stripe_secret_key);

try {
    // Λήψη δεδομένων πτήσης από τη φόρμα μεθόδου POST
    $flight_id = $_POST['flight_id'];
    $flight_num = $_POST['flight_num'];
    $flight_origin = $_POST['flight_origin'];
    $flight_dest = $_POST['flight_dest'];
    $flight_date = $_POST['flight_date'];
    $flight_dep_time = $_POST['flight_dep_time'];
    $flight_price = $_POST['flight_price'];
    $airline_name = $_POST['airline_name'];

    // Δημιουργία συνεδρίας πληρωμής με βάση τα δεδομένα της πτήσης
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/air/ticket.php",
        "cancel_url" => "http://localhost/air/flight-search.php",
        "locale" => "auto",
        "payment_method_types" => ["card"], // Επιτρέπουμε μόνο την πληρωμή με κάρτα
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => $flight_price * 100, // Οι τιμές στο Stripe πρέπει να είναι σε ακέραιο αριθμό ανά cents
                    "product_data" => [
                        "name" => "Flight Ticket", // Μπορείτε να προσαρμόσετε το όνομα του προϊόντος όπως εσείς θέλετε
                        "description" => "Flight from {$flight_origin} to {$flight_dest} on {$flight_date} at {$flight_dep_time} with {$airline_name}" // Περιγραφή της πτήσης
                    ]
                ]
            ]
        ]
    ]);

    // Ανακατεύθυνση στη σελίδα πληρωμής του Stripe
    http_response_code(303);
    header("Location: " . $checkout_session->url);
    exit;
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
    <body>
    <h2>Flight Details:</h2>
    <p>Flight ID: <?php echo $flight_id; ?></p>
    <p>Flight Number: <?php echo $flight_num; ?></p>
    <p>From: <?php echo $flight_origin; ?></p>
    <p>To: <?php echo $flight_dest; ?></p>
    <p>Date: <?php echo $flight_date; ?></p>
    <p>Departure Time: <?php echo $flight_dep_time; ?></p>
    <p>Airline: <?php echo $airline_name; ?></p>


    <h2>Payment Details:</h2>
    <!-- Προσθέστε εδώ τη φόρμα για τα στοιχεία της πληρωμής -->
    <form action="" method="POST">
        <!-- Προσθήκη κρυφών πεδίων για τις πληροφορίες της πτήσης -->
        <input type="hidden" name="flight_id" value="<?php echo $flight_id; ?>">
        <input type="hidden" name="flight_num" value="<?php echo $flight_num; ?>">
        <input type="hidden" name="flight_origin" value="<?php echo $flight_origin; ?>">
        <input type="hidden" name="flight_dest" value="<?php echo $flight_dest; ?>">
        <input type="hidden" name="flight_date" value="<?php echo $flight_date; ?>">
        <input type="hidden" name="flight_dep_time" value="<?php echo $flight_dep_time; ?>">
        <input type="hidden" name="flight_price" value="<?php echo $flight_price; ?>">
        <input type="hidden" name="airline_name" value="<?php echo $airline_name; ?>">

        <label for="card_holder_name">Card Holder Name:</label>
        <input type="text" id="card_holder_name" name="card_holder_name" required><br><br>
        
        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" required><br><br>
        
        <label for="expiry_date">Expiry Date:</label>
        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required><br><br>
        
        <label for="cvc">CVC:</label>
        <input type="text" id="cvc" name="cvc" required><br><br>

        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
