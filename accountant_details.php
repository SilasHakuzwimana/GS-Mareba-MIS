<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant Information</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file for styling -->
    <link rel="icon" href="images/accountant.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .accountant-list {
            margin-top: 20px;
        }

        .accountant-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .accountant-item p {
            margin: 5px 0;
            color: #333;
        }

        .accountant-item p:first-child {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Accountant Information</h2>
        <h4><a href="accountant_management_dashboard.php">Back to dashboard</a></h4>
        <div class="accountant-list">
        <?php
// Include the database connection file
include 'db_connection.php';

// Check if the user is logged in and get their MIS_userID from the session
session_start();
if(isset($_SESSION['MIS_userID'])) {
    $MIS_userID = $_SESSION['MIS_userID'];

    // Define the SQL query to fetch user details based on MIS_userID
    $sql = "SELECT * FROM school_mis_users_table WHERE MIS_userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MIS_userID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any user records exist
    if ($result->num_rows > 0) {
        // Output data of the user
        $row = $result->fetch_assoc();
        echo "<h2>User Details</h2>";
        echo "<p>MIS userID: " . $row["MIS_userID"] . "</p>"; // Use "MIS_userID" instead of "ID"
        echo "<p>Full Name: " . $row["Full_Names"] . "</p>"; // Use "Full_Names" instead of "full_name"
        echo "<p>ID Number: " . $row["ID_number"] . "</p>"; // Use "ID_number" instead of "id"
        echo "<p>Username: " . $row["Username"] . "</p>"; // Use "Username" instead of "username"
        echo "<p>Email: " . $row["Email"] . "</p>"; // Use "Email" instead of "email"
        echo "<p>Profile: " . $row["User_profile"] . "</p>"; // Use "User_profile" instead of "user_profile"
        echo "<p>Phone number: " . $row["Phone_number"] . "</p>"; // Use "Phone_number" instead of "phone_number"
    } else {
        echo "<p>No user records found</p>";
    }

    // Close the database connection
    $stmt->close();
} else {
    echo "<p>User not logged in</p>";
}

// Close the database connection
$conn->close();
?>
        </div>
    </div>
</body>
</html>
