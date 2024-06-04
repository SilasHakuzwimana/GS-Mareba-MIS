<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password reset</title>
    <link rel="icon" href="password_reset.png">
</head>
<body>
<?php
session_start();

$servername = "localhost";
$userName = "root";
$passWord = "";
$dbname = "school_mis_database";

$conn = new mysqli($servername, $userName, '', $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["username"];

    // Generate a unique token
    $resetToken = bin2hex(random_bytes(32));
    $Reset_time = date('Y-m-d H:i:s', strtotime('+1 hour'));
    echo "Current Time: " . date('Y-m-d H:i:s') . "<br>";
    echo "Reset Time: " . $Reset_time . "<br>";

    // Update user's record with the reset token and expiry
    $updateQuery = "UPDATE school_mis_users_table SET Password_Reset_token='$resetToken', Password_Reset_time='$Reset_time' WHERE Username='$Username'";
    
    if ($conn->query($updateQuery) === TRUE) {
        // Send a reset link to the user's email (simulate in a real environment)
        $resetLink = "http:/gsmarebaTss/reset_password_confirm.php?token=$resetToken";
            // Output the link
    echo "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>   
</body>
</html>
