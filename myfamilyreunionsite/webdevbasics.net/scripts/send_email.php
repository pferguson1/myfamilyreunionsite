<?php
// === send_email.php ===
// Collect form data and send it via email to techwriter35@duck.com

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "techwriter35@duck.com"; // your email address
    $subject = "New Family Reunion Form Submission";

    // Collect and sanitize input fields
    $fname = htmlspecialchars($_POST['myFName'] ?? '');
    $lname = htmlspecialchars($_POST['myLName'] ?? '');
    $email = htmlspecialchars($_POST['myEmail'] ?? '');
    $phone = htmlspecialchars($_POST['myPhone'] ?? '');
    $arrival = htmlspecialchars($_POST['myArrival'] ?? '');
    $departure = htmlspecialchars($_POST['myDeparture'] ?? '');
    $nights = htmlspecialchars($_POST['myNights'] ?? '');
    $comments = htmlspecialchars($_POST['myComments'] ?? '');

    // Build the message
    $message = "
    <h2>New Family Reunion Form Submission</h2>
    <p><strong>First Name:</strong> $fname</p>
    <p><strong>Last Name:</strong> $lname</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Arrival Date:</strong> $arrival</p>
    <p><strong>Departure Date:</strong> $departure</p>
    <p><strong>Number of Nights:</strong> $nights</p>
    <p><strong>Comments:</strong> $comments</p>
    ";

    // Email headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Family Reunion Form <no-reply@yourdomain.com>" . "\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "<h3>✅ Thank you, your form has been submitted successfully!</h3>";
    } else {
        echo "<h3>❌ Sorry, there was an error sending your message. Please try again later.</h3>";
    }
} else {
    echo "<h3>Invalid request.</h3>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>HAYGOOD • DAVIS • HOOD • FLEMISTER FAMILY REUNION</title>

</head>

<body>

    <h1> Reservations For Reunion</h1>
    <div id="content">
        <h2>We will be contacting you soon!</h2>
        <h3>Here is the information you entered:</h3><br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <form action="send_email.php">
            <input type="button" value="Back" onclick="javascript:history.go(-1)" />
        </form>
    </div>
    </div>
    <script>
        // Clear button function
        document.getElementById("clearBtn").addEventListener("click", function() {
            if (confirm("Are you sure you want to clear the form?")) {
                document.getElementById("reunionForm").reset();
            }
        });
    </script>

</body>

</html>