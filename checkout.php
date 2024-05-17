<?php

require_once __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PHGknFkiVHNe1mtTXNwkJyfpBRq3RSM9oBIs7qVgI4BK9ZxbMpA1pnChsz30RxghkmbIDF26SAnO6m0I1P4h3tf00y6YtJfgM";
// Stripe API library
\Stripe\Stripe::setApiKey($stripe_secret_key);

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/air/ticket.php",
        "cancel_url" => "http://localhost/air/Flight_Search_Results.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => 2000,
                    "product_data" => [
                        "name" => "T-shirt"
                    ]
                ]
            ],
            [
                "quantity" => 2,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => 700,
                    "product_data" => [
                        "name" => "Hat"
                    ]
                ]
            ]        
        ]
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);
    exit;
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error: " . $e->getMessage();
}
