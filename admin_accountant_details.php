<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Information</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file for styling -->
    <link rel="icon" href="images/user_info.png">
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

        .actions {
            margin-top: 10px;
        }

        .actions a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function confirmDeletion(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "delete_user.php?id=" + userId;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Users Information</h2>
        <h4><a href="adminpage.php">Back to dashboard</a></h4>
        <div class="accountant-list">
            <?php
            // Include the database connection file
            include 'db_connection.php';

            // Define the SQL query to fetch accountant information
            $sql = "SELECT * FROM school_mis_users_table";
            $result = $conn->query($sql);

            // Check if any accountant records exist
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='accountant-item'>";
                    echo "<p>MIS userID: " . $row["MIS_userID"] . "</p>";
                    echo "<p>Full Name: " . $row["Full_Names"] . "</p>";
                    echo "<p>ID Number: " . $row["ID_number"] . "</p>";
                    echo "<p>Username: " . $row["Username"] . "</p>";
                    echo "<p>Email: " . $row["Email"] . "</p>";
                    echo "<p>Profile: " . $row["User_profile"] . "</p>";
                    echo "<p>Phone number: " . $row["Phone_number"] . "</p>";
                    echo "<div class='actions'>";
                    echo "<a href='edit_user.php?id=" . $row["MIS_userID"] . "'>Edit</a>";
                    echo "<a href='#' onclick='confirmDeletion(" . $row["MIS_userID"] . ")'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No accountant records found</p>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
