<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "swiftskies"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Αν έχουν συμπληρωθεί πεδία αναζήτησης, χρησιμοποίησε τις τιμές αυτές στο ερώτημα SQL
if(isset($_POST['flying_from']) && isset($_POST['flying_to']) && isset($_POST['departing'])) {
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $departing = $_POST['departing'];
    
    // Τροποίησε το ερώτημα SQL για να εμφανίζει μόνο τα αποτελέσματα που ταιριάζουν με τις τιμές που έδωσε ο χρήστης
    $sql = "SELECT * FROM addflights WHERE ORIGIN = '$flying_from' AND DEST = '$flying_to' AND TIME(DEP_TIME) >= '$departing'";
} else {
    // Αν δεν έχουν συμπληρωθεί πεδία αναζήτησης, επιστρέψε όλες τις πτήσεις
    $sql = "SELECT * FROM addflights";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <!-- Εμφάνιση των αποτελεσμάτων εδώ -->
        <div class="col-md-6">
            <!-- Κάρτα πτήσης -->
            <p><?php echo $row['FLIGHTNUM']; ?></p>
            <p><?php echo $row['ORIGIN']; ?></p>
            <p><?php echo $row['DEST']; ?></p>
            <p><?php echo $row['DATE']; ?></p>
            <p><?php echo $row['DEP_TIME']; ?></p>
            <p><?php echo $row['ARR_TIME']; ?></p>
            <p><?php echo $row['price']; ?></p>
        </div>
    <?php
    }
} else {
    echo "0 results";
}
$conn->close();
?>
