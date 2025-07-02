<?php
// Database connection details
$servername = "localhost"; // Change if your database is on another host
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "cleaning_services"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $cardNumber = mysqli_real_escape_string($conn, $_POST['cardNumber']);
    $expiryDate = mysqli_real_escape_string($conn, $_POST['expiryDate']);
    $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);

    // Ensure that all fields are filled out
    if (empty($name) || empty($email) || empty($cardNumber) || empty($expiryDate) || empty($cvv)) {
        die("All fields are required.");
    }

    // Mask the card number (only showing the last 4 digits)
    $maskedCardNumber = "**** **** **** " . substr($cardNumber, -4);

    // Prepare and bind the query to insert the data
    $stmt = $conn->prepare("INSERT INTO payments (name, email, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $maskedCardNumber, $expiryDate, $cvv);

    // Execute the query and check for success
    if ($stmt->execute()) {
       echo "<script type='text/javascript'>alert('Booking Successfully!');window.location.href = 'Home.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
