<?php
session_start();

$servername = "localhost";
$userName = "root";
$passWord = "";
$dbname = "school_mis_database";

$conn = new mysqli($servername, $userName, $passWord, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Password strength validation function
    function validatePasswordStrength($password) {
        $minLength = 8;
        $hasUpperCase = preg_match("/[A-Z]/", $password);
        $hasLowerCase = preg_match("/[a-z]/", $password);
        $hasNumbers = preg_match("/[0-9]/", $password);
        $hasSpecialChars = preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password);

        if (strlen($password) < $minLength) {
            return "Password must be at least $minLength characters long.";
        }
        if (!$hasUpperCase) {
            return "Password must contain at least one uppercase letter.";
        }
        if (!$hasLowerCase) {
            return "Password must contain at least one lowercase letter.";
        }
        if (!$hasNumbers) {
            return "Password must contain at least one number.";
        }
        if (!$hasSpecialChars) {
            return "Password must contain at least one special character.";
        }
        return "";
    }

    // Validate the password strength
    $passwordError = validatePasswordStrength($password);
    if ($passwordError) {
        echo "<p style='color: red;'>$passwordError</p>";
    } else {
        // Hash the password using Argon2 algorithm
        $options = [
            'memory_cost' => 1<<17, // 128 MB
            'time_cost' => 4,
            'threads' => 3,
        ];
        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID, $options);

        // Update user's record with the new password
        $updatePasswordQuery = "UPDATE school_mis_users_table SET Password='$hashedPassword', Password_Reset_token=NULL, Password_Reset_time=NULL WHERE email='$email'";
        if ($conn->query($updatePasswordQuery) === TRUE) {
            echo "Password reset successfully!";
        } else {
            echo "Error resetting password: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="icon" href="reset.png">
    <style>
        a {
            text-decoration: none;
            color: blue;
            font-size: 20px;
        }
        .login {
            background-color: black;
        }
        form {
            background-color: violet;
            text-align: center;
            align-items: center;
            margin: auto;
            position: relative;
            top: 50px;
            width: 300px;
            height: 350px;
        }
        h2 {
            background-color: green;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-weight: 300;
            font-style: oblique;
            font-size: 30px;
            height: fit-content;
            text-align: center;
        }
        body {
            background-color: whitesmoke;
        }
        footer {
            background-color: goldenrod;
            text-align: center;
            font-size: larger;
            font-style: oblique;
        }
        .header {
            background-color: goldenrod;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-weight: 300;
            font-style: oblique;
            font-size: 30px;
            height: fit-content;
            text-align: center;
        }
        #librarian_dashboard_footer {
            background-color: cornflowerblue;
            color: white;
            text-align: center;
            position: relative; top: 40px;
            height: 50px;
        }
        #gsmareba_paragraph {
            position: relative; top: 20px;
            color: white;
        }
    </style>
</head>
<body>
    
    <h2 class="header">Welcome to reset password page!</h2>

    <form action="reset_password_confirm.php" method="post">
        <h2>Password reset form</h2><br><br>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Reset Password">
        <p class="back"><a href="login_user.php">Back to Login</a></p>
    </form>

    <br><br><br>
    <footer id="librarian_dashboard_footer">
        <p id="gsmareba_paragraph">MIS reset password &copy;<span id="copyright-year"></span> All right reserved!</p>
    </footer>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current year
    const currentYear = new Date().getFullYear();
    document.getElementById('copyright-year').textContent = currentYear;
});
</script>
</body>
</html>
