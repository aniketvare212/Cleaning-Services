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

// Check if 'id' is passed in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record from the database
    $sql = "DELETE FROM bookings WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Booking deleted successfully.";
        header("Location: booking_list.php");
        exit();
    } else {
        echo "Error deleting booking: " . $conn->error;
    }
} else {
    echo "No ID specified.";
}

$conn->close();
?>
