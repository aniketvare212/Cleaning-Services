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

// Fetch all data from bookings table
$sql = "SELECT id, name, email, service, date, address FROM bookings";
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    echo "<html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
                    table { width: 100%; margin: 20px 0; border-collapse: collapse; }
                    th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
                    th { background-color: #4CAF50; color: white; }
                    tr:nth-child(even) { background-color: #f2f2f2; }
                    tr:hover { background-color: #ddd; }
                    .container { max-width: 1200px; margin: auto; padding: 20px; background-color: white; border-radius: 8px; }
                    .action-buttons { display: flex; gap: 10px; }
                    .action-buttons a { padding: 5px 10px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px; }
                    .action-buttons a:hover { background-color: #0056b3; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Booking Records</h2>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>";

    // Output each row of data in the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['service'] . "</td>
                <td>" . $row['date'] . "</td>
                <td>" . $row['address'] . "</td>
                <td class='action-buttons'>
                    <a href='update.php?id=" . $row['id'] . "'>Update</a>
                    <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                </td>
              </tr>";
    }

    // End the table
    echo "</table>
                </div>
            </body>
          </html>";
} else {
    echo "No bookings found.";
}

// Close the connection
$conn->close();
?>



<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cleaning_services";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is passed in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the booking ID from the URL
    $id = $_GET['id'];

    // Fetch the booking data for the specified ID
    $sql = "SELECT * FROM bookings WHERE id = $id";
    $result = $conn->query($sql);

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No booking found with the given ID.";
        exit();
    }

    // If the form is submitted, update the record
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $service = $_POST['service'];
        $date = $_POST['date'];
        $address = $_POST['address'];

        // Update the record in the database
        $update_sql = "UPDATE bookings SET name='$name', email='$email', service='$service', date='$date', address='$address' WHERE id=$id";

        if ($conn->query($update_sql) === TRUE) {
            // Redirect back to the booking list after successful update
            header("Location: manage_booking.php");
            exit();
        } else {
            echo "Error updating booking: " . $conn->error;
        }
    }
} else {
    echo "No ID specified in the URL.";
    exit();
}

// Close the connection
$conn->close();
?>
