<?php
// Database connection details
$host = 'localhost';
$db = 'cleaning_services'; // Ensure the database exists
$user = 'root'; // Your MySQL username (default is 'root')
$pass = ''; // MySQL password (leave blank if default is used)

try {
    // Establish PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}

// Fetch total bookings count
$stmt = $pdo->query("SELECT COUNT(*) AS total_bookings FROM bookings");
$totalBookings = $stmt->fetch(PDO::FETCH_ASSOC)['total_bookings'];

// Fetch total registrations count
$stmt = $pdo->query("SELECT COUNT(*) AS total_users FROM register");
$totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

$stmt = $pdo->query("SELECT COUNT(*) AS total_feedback FROM contact_us");
$totalfeedback = $stmt->fetch(PDO::FETCH_ASSOC)['total_feedback'];

// Fetch total payments count
$stmt = $pdo->query("SELECT COUNT(*) AS total_payments FROM payments");
$totalPayments = $stmt->fetch(PDO::FETCH_ASSOC)['total_payments'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <style>
        /* Basic reset for margins and paddings */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fc;
    color: #333;
}

/* Dashboard container */
.dashboard {
    display: flex;
}

/* Sidebar styling */
.sidebar {
    background-color: #2f3b52;
    color: white;
    width: 250px;
    height: 100vh;
    padding: 20px;
    position: fixed;
}

.sidebar h2 {
    font-size: 1.8em;
    margin-bottom: 30px;
}

.sidebar ul {
    list-style-type: none;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    text-decoration: none;
    color: white;
    font-size: 1.2em;
}

.sidebar ul li a:hover {
    text-decoration: underline;
}

/* Main content area */
.main-content {
    margin-left: 270px;
    padding: 20px;
    width: 100%;
}

header {
    background-color: #fff;
    border-bottom: 2px solid #ccc;
    padding: 20px 0;
}

header h1 {
    font-size: 2em;
    color: #333;
}

/* Cards for displaying data */
.cards {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 30%;
    padding: 20px;
    text-align: center;
    font-size: 1.5em;
    color: #333;
}

.card h3 {
    font-size: 1.2em;
    margin-bottom: 10px;
}

.card p {
    font-size: 2em;
    font-weight: bold;
    color: #4CAF50; /* Green color for counts */
}
</style>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="manage booking.php">Bookings</a></li>
                <li><a href="manage registration.php">Registrations</a></li>
                <li><a href="manage feedback.php">Feedbacks</a></li>
                <li><a href="manage payment.php">Payments</a></li>
                <li><a href="login.html">Logout</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header>
                <h1>Welcome, Admin</h1>
            </header>
            <section id="dashboard">
                <h2>Dashboard Overview</h2>
                <div class="cards">
                    <div class="card">
                        <h3>Total Bookings</h3>
                        <p><?php echo $totalBookings; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Registrations</h3>
                        <p><?php echo $totalUsers; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Feedbacks</h3>
                        <p><?php echo $totalfeedback; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Payments</h3>
                        <p><?php echo $totalPayments; ?></p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
