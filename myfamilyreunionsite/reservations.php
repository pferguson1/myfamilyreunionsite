<?php
// ==== 1. Database connection ====
$servername = "localhost";   // change if needed
$username = "your_db_username";
$password = "your_db_password";
$dbname = "family_reunion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ==== 2. Collect form data ====
$first_name = $_POST['myFName'] ?? '';
$last_name  = $_POST['myLName'] ?? '';
$email      = $_POST['myEmail'] ?? '';
$phone      = $_POST['myPhone'] ?? '';
$arrival    = $_POST['myArrival'] ?? '';
$departure  = $_POST['myDeparture'] ?? '';
$nights     = $_POST['myNights'] ?? '';
$comments   = $_POST['myComments'] ?? '';

// ==== 3. Insert into database ====
$stmt = $conn->prepare("INSERT INTO reservations 
  (first_name, last_name, email, phone, arrival_date, departure_date, nights, comments)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssis", $first_name, $last_name, $email, $phone, $arrival, $departure, $nights, $comments);

if (!$stmt->execute()) {
    die("Database error: " . $stmt->error);
}

// ==== 4. Send email notification ====
$content = "
  <h2>New Family Reunion Reservation</h2>
  <p><strong>Name:</strong> $first_name $last_name</p>
  <p><strong>Email:</strong> $email</p>
  <p><strong>Phone:</strong> $phone</p>
  <p><strong>Arrival:</strong> $arrival</p>
  <p><strong>Departure:</strong> $departure</p>
  <p><strong>Nights:</strong> $nights</p>
  <p><strong>Comments:</strong> $comments</p>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@yourdomain.com\r\n";

mail("techwriter35@duck.com", "New Family Reunion Reservation", $content, $headers);

// ==== 5. Confirmation output ====
echo "<h3>Thank you! Your reservation has been recorded and emailed successfully.</h3>";

$conn->close();
