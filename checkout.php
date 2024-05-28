<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PHGknFkiVHNe1mtTXNwkJyfpBRq3RSM9oBIs7qVgI4BK9ZxbMpA1pnChsz30RxghkmbIDF26SAnO6m0I1P4h3tf00y6YtJfgM";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/air/ticket.php",
        "cancel_url" => "http://localhost/air/flight-search.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 10000,
                "product_data" => [
                    "name" => "ATH to JFK"
                ]
                
            ]
        ],
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 50000,
                "product_data" => [
                    "name" => "JFK to ATH"
                ]
            ]
        ]        
    ]
]);

http_response_code(303);
header("Location: " . $checkout_session->url);
