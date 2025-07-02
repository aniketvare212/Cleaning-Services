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

// Handle Delete operation
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM register WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Deleted Successfully!');window.location.href = 'manage registration.php';</script>";
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle Update operation
if (isset($_POST['update_id']) && !empty($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    $update_sql = "UPDATE register SET name='$name', email='$email', hashed_password='$password' WHERE id=$update_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Update Successfully!');window.location.href = 'manage registration.php';</script>";
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch all data from register table
$sql = "SELECT id AS id, name, email, password FROM register";
$result = $conn->query($sql);


// Check if there are any records
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Registrations</title>
    <style>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .action-buttons a:hover {
            background-color: #0056b3;
        }

    </style>
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Records</h2>

        <?php
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['password'] . "</td>
                <td class='action-buttons'>
                   <a href='?update_id=" . $row['id'] . "'>Update</a>
<a href='?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>

                </td>
              </tr>";
        
            }

            echo "</table>";
        } else {
            echo "No records found.";
        }
        ?>

        <?php
        // Show update form if an update_id is passed
        if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
            $update_id = $_GET['update_id'];
            $update_sql = "SELECT * FROM register WHERE user_id = $update_id";
            $update_result = $conn->query($update_sql);

            if ($update_result->num_rows > 0) {
                $row = $update_result->fetch_assoc();
                ?>

                <h3>Update Registration</h3>
                <form method="POST">
                    <input type="hidden" name="update_id" value="<?php echo $row['user_id']; ?>">

                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" required>

                    <button type="submit">Update Registration</button>
                </form>

                <?php
            }
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
