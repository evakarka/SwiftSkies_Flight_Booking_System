<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genius Deal!</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.deal-header {
    background-color: #2eb82e;
    color: white;
    padding: 15px;
    font-size: 20px;
    text-align: center;
}

.flight-info {
    padding: 20px;
    border-bottom: 1px solid #ddd;
}

.section {
    margin-bottom: 20px;
}

.section-title {
    font-size: 16px;
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
}

.flight-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.time {
    font-size: 20px;
    font-weight: bold;
}

.flight-duration {
    text-align: center;
}

.duration {
    font-size: 14px;
}

.direct {
    font-size: 12px;
    color: #888;
}

.location {
    text-align: right;
    font-size: 14px;
    color: #555;
}

.bag {
    font-size: 14px;
    color: #555;
    text-align: right;
}

.price-info {
    padding: 20px;
    text-align: center;
}

.non-discounted {
    font-size: 14px;
    color: #888;
    text-decoration: line-through;
    margin-bottom: 10px;
}

.prime-price {
    background-color: #f8f8f8;
    padding: 20px;
    border-radius: 8px;
}

.prime-text {
    font-size: 14px;
    font-weight: bold;
}

.trial-text {
    font-size: 12px;
    color: #888;
    display: block;
    margin-bottom: 10px;
}

.prime-fare {
    font-size: 24px;
    font-weight: bold;
    color: #2eb82e;
    margin-bottom: 10px;
}

.original-fare {
    font-size: 14px;
    color: #888;
    text-decoration: line-through;
    margin-bottom: 10px;
}

.tickets-left {
    font-size: 14px;
    color: red;
    margin-bottom: 20px;
}

.select-button {
    background-color: #2e6be2;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

.select-button:hover {
    background-color: #1a4a99;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="deal-header">Genius deal!</div>
        <div class="flight-info">
            <div class="section">
                <span class="section-title">DEPARTURE • Transavia France</span>
                <div class="flight-details">
                    <div class="time">06:30</div>
                    <div class="flight-duration">
                        <span class="duration">3h 30m</span>
                        <span class="direct">direct</span>
                    </div>
                    <div class="time">09:00</div>
                    <div class="location">
                        <div class="from">E. Venizelos (ATH) Athens</div>
                        <div class="to">Orly (ORY) Paris</div>
                    </div>
                    <div class="bag">1 small bag</div>
                </div>
            </div>
            <div class="section">
                <span class="section-title">RETURN • Transavia France</span>
                <div class="flight-details">
                    <div class="time">19:15</div>
                    <div class="flight-duration">
                        <span class="duration">3h 15m</span>
                        <span class="direct">direct</span>
                    </div>
                    <div class="time">23:30</div>
                    <div class="location">
                        <div class="from">Orly (ORY) Paris</div>
                        <div class="to">E. Venizelos (ATH) Athens</div>
                    </div>
                    <div class="bag">1 small bag</div>
                </div>
            </div>
        </div>
        <div class="price-info">
            <div class="non-discounted">Non-discounted fare: €339</div>
            <div class="prime-price">
                <span class="prime-text">Prime price</span>
                <span class="trial-text">15-day free trial</span>
                <div class="prime-fare">€270</div>
                <div class="original-fare">€339</div>
                <div class="tickets-left">Only 3 tickets left!</div>
                <button class="select-button">Select</button>
            </div>
        </div>
    </div>
</body>
</html>
