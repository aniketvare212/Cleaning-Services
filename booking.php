<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cleaning_services"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form echodata is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Ensure that all fields are filled out
    if (empty($name) || empty($email) || empty($service) || empty($date) || empty($address)) {
        die("All fields are required.");
    }

    // Prepare and bind statement to insert data
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, service, date, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $service, $date, $address);

    // Execute the query and check for success
    if ($stmt->execute()) {
        // If the booking is successful, display a popup message
         echo"<script type='text/javascript'>alert('Booking Successfully!');window.location.href = 'payment.html';</script>";
    } else {
        // If there is an error, display the error message
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
