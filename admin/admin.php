<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Airline Company - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">SwiftSkies - Airline Company</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="index.html" class="nav-link" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="passenger.html" class="nav-link">Passengers</a></li>
        <li class="nav-item"><a href="flights.html" class="nav-link">Flights</a></li>
        <li class="nav-item"><a href="staff.html" class="nav-link">Staff</a></li>
        <li class="nav-item"><a href="airplane.html" class="nav-link">Airplanes</a></li>
        <li class="nav-item"><a href="city.html" class="nav-link">City</a></li>
        <li class="nav-item"><a href="#" class="nav-link active">Admin</a></li>
      </ul>
    </header>
  </div>

  <div class="container">
    <h2>Admin Panel</h2>
    <table class="table">
      <thead>
        <tr>
          <th>NUM</th>
          <th>SURNAME</th>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>ROLE</th>
          <th>RESPONDER</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Συμπερίληψη του αρχείου σύνδεσης στη βάση δεδομένων
          include 'php/database.php';

          // Εδώ θα πρέπει να προσθέσετε τον κώδικα PHP που επιλέγει τις εγγραφές από τη βάση δεδομένων

          // Εδώ θα πρέπει να εμφανίσετε δυναμικά τις εγγραφές στον πίνακα
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    function acceptRecord(index) {
      // Εδώ μπορείτε να προσθέσετε τον κώδικα JavaScript που θα εκτελεστεί όταν πατηθεί το εικονίδιο αποδοχής
      console.log("Accepted record at index " + index);
    }

    function rejectRecord(index) {
      // Εδώ μπορείτε να προσθέσετε τον κώδικα JavaScript που θα εκτελεστεί όταν πατηθεί το εικονίδιο απόρριψης
      console.log("Rejected record at index " + index);
    }
  </script>
</body>

</html>
