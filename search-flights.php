<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "swiftskies"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$flying_from = isset($_POST['flying_from']) ? $_POST['flying_from'] : '';
$flying_to = isset($_POST['flying_to']) ? $_POST['flying_to'] : '';
$departing = isset($_POST['departing']) ? $_POST['departing'] : '';
$returning = isset($_POST['returning']) ? $_POST['returning'] : '';

$flights = [];

if ($flying_from && $flying_to && $departing) {
    // Αναχώρηση
    $sql_depart = "SELECT * FROM addflights WHERE ORIGIN = ? AND DEST = ? AND DATE >= ?";
    $stmt_depart = $conn->prepare($sql_depart);
    $stmt_depart->bind_param("sss", $flying_from, $flying_to, $departing);
    $stmt_depart->execute();
    $result_depart = $stmt_depart->get_result();
    
    if ($result_depart->num_rows > 0) {
        while($row = $result_depart->fetch_assoc()) {
            $flights['depart'][] = $row;
        }
    }

    // Επιστροφή
    if ($returning) {
        $sql_return = "SELECT * FROM addflights WHERE ORIGIN = ? AND DEST = ? AND DATE >= ?";
        $stmt_return = $conn->prepare($sql_return);
        $stmt_return->bind_param("sss", $flying_to, $flying_from, $returning);
        $stmt_return->execute();
        $result_return = $stmt_return->get_result();
        
        if ($result_return->num_rows > 0) {
            while($row = $result_return->fetch_assoc()) {
                $flights['return'][] = $row;
            }
        }
    }
} else {
    // Αν δεν έχουν συμπληρωθεί πεδία αναζήτησης, επιστρέψε όλες τις πτήσεις
    $sql = "SELECT * FROM addflights";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $flights['all'][] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Search Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-0KmPIbhT+eYJ5FpkiXNc9XyZ/cf4W5VuIj/gElZb/+9cXRC4gmDq4dyExzXvzk+o1lwVVpYq2WdEvtep3dbI8A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f2f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding-top: 20px;
        }
        .section-title {
            font-size: 2rem;
            color: #002144;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .result-card {
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
            background-color: #fff;
        }
        .result-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 20px;
        }
        .flight-details {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .flight-details img {
            margin-right: 15px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .flight-details h5 {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }
        .flight-price {
            font-size: 1.25rem;
            color: #28a745;
            font-weight: bold;
        }
        .airline-name {
            font-size: 1rem;
            color: #6c757d;
        }
        .flight-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #555;
        }
        .book-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1rem;
        }
        .book-button:hover {
            background-color: #0056b3;
        }
        .no-results {
            font-size: 1.2rem;
            text-align: center;
            color: #555;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<section class="container mt-5">
    <h1 class="section-title">Flight Search Results</h1>
    <?php if (!empty($flights)): ?>
        <?php if (isset($flights['depart'])): ?>
            <div class="section-title">Departure Flights</div>
            <div class="row">
                <?php foreach ($flights['depart'] as $flight): ?>
                    <div class="col-md-6">
                        <div class="card result-card">
                            <div class="card-body">
                                <div class="flight-details">
                                    <?php if (!empty($flight['image'])): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($flight['image']); ?>" alt="Airline Logo">
                                    <?php else: ?>
                                        <img src="img/default-logo.png" alt="Default Logo">
                                    <?php endif; ?>
                                    <div>
                                        <h5><?php echo $flight['FLIGHTNUM']; ?></h5>
                                        <span class="flight-price">$<?php echo $flight['price']; ?></span>
                                        <p class="airline-name"><?php echo $flight['AIRLINE_NAME']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="flight-info">
                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $flight['ORIGIN']; ?></p>
                                    <i class="fas fa-plane"></i>
                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $flight['DEST']; ?></p>
                                </div>
                                <div class="flight-info">
                                    <p><i class="far fa-clock"></i> <?php echo $flight['DEP_TIME']; ?></p>
                                    <p><i class="far fa-clock"></i> <?php echo $flight['ARR_TIME']; ?></p>
                                </div>
                                <button class="book-button" onclick="redirectToPay()"><i class="fas fa-ticket-alt"></i> Book Now</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($flights['return'])): ?>
            <div class="section-title">Return Flights</div>
            <div class="row">
                <?php foreach ($flights['return'] as $flight): ?>
                    <div class="col-md-6">
                        <div class="card result-card">
                            <div class="card-body">
                                <div class="flight-details">
                                    <?php if (!empty($flight['image'])): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($flight['image']); ?>" alt="Airline Logo">
                                    <?php else: ?>
                                        <img src="img/default-logo.png" alt="Default Logo">
                                    <?php endif; ?>
                                    <div>
                                        <h5><?php echo $flight['FLIGHTNUM']; ?></h5>
                                        <span class="flight-price">$<?php echo $flight['price']; ?></span>
                                        <p class="airline-name"><?php echo $flight['AIRLINE_NAME']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="flight-info">
                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $flight['ORIGIN']; ?></p>
                                    <i class="fas fa-plane"></i>
                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $flight['DEST']; ?></p>
                                </div>
                                <div class="flight-info">
                                    <p><i class="far fa-clock"></i> <?php echo $flight['DEP_TIME']; ?></p>
                                    <p><i class="far fa-clock"></i> <?php echo $flight['ARR_TIME']; ?></p>
                                </div>
                                <button class="book-button" onclick="redirectToPay()"><i class="fas fa-ticket-alt"></i> Book Now</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="section-title">No Return Flights Available</div>
    <?php endif; ?>
</section>
<script>
    function redirectToPay() {
        window.location.href = "bookingticket.php";
    }
</script>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>


