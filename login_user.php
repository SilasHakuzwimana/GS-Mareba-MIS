<?php
session_start();

// Initialize $errorMessage variable
$errorMessage = "";

// Database credentials
$serverName = 'localhost';
$userName = 'root';
$password = '';
$database = 'school_mis_database';

// Establish a database connection
$conn = new mysqli($serverName, $userName, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL statement to fetch user details
    $stmt = $conn->prepare("SELECT * FROM school_mis_users_table WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $row = $result->fetch_assoc();
        $storedPassword = $row['Password'];
        $userProfile = $row['User_profile'];
        $misUserID = $row['MIS_userID'];

        // Verify password
        if (password_verify($password, $storedPassword)) {
            // Password is correct
            // Set session variables
            $_SESSION['MIS_userID'] = $misUserID;
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['Email'] = $row['Email'];

            // Redirect user based on user profile
            if ($userProfile === 'Administrator') {
                header("Location: adminpage.php");
                exit;
            } elseif ($userProfile === 'Librarian') {
                header("Location: librarian_management_page.php");
                exit;
            } elseif ($userProfile === 'Accountant') {
                header("Location: accountant_management_dashboard.php");
                exit;
            } else {
                $errorMessage = "Invalid user profile.";
            }
        } else {
            $errorMessage = "Login failed: Invalid username or password.";
        }
    } else {
        $errorMessage = "Login failed: User not found.<br>Request an administrator to register you!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSMT Management Information System login</title>
    <link rel="icon" href="images/login.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .password-container {
                    position: relative;
                    text-decoration:none;
                }
        #passwordToggle{
                    position: relative;left: 2px;
                }
        form{
                text-align: center;
                background-color: darkgray;
                border-radius: 20px;
                position: relative;top: 5px;left: 400px;
                width: 400px;
                height: 530px;
                text-decoration:none;
                }
        .header{
                background-color: slategray;
                color: white;
                height: 60px;
                text-align: center;
                }
        #submit_user_details{
                background-color: rgb(8, 96, 125);
                color: rgb(233, 233, 241);
                position: relative;left: 130px;
                height: 30px;
                width: 98px;
                font-size: 20px;
                border-radius: 15px;
                border-color: aqua;
                }
        #login_header{
                position: relative;top: 20px;
                background-color: slategray;
                color: white;
                height: 70px;
                text-align: center;
                font-size: 30px;
                }
        .login_details{
                font-size: 20px;
                }
        input{
                width: 350px;
                height: 35px;
                }
        button{
                color:black;
                text-decoration:none;
                text-align:center;
                }
        .reference_home{
                text-decoration: none;
                color: black;
                }
        #forget_password{
                background-color: cornflowerblue;
                color: white;
                height: 30px;
                width: 50%;
                border-radius: 15px;
                font-size: 17px;
                text-decoration:none;
                }
        #reset_form{
                border-radius: 10px;
                background-color: darkkhaki;
                width: 170px;
                height: 40px;
                font-size: 20px;
                text-decoration:none;
                }
        #password{
                width:330px;
                text-decoration:none;
                }
                a{
                    text-decoration:none;
                    color:white;
                }
    </style>
</head>
<body>
    <form action="login_user.php" method="post">
        <div class="header">
       <h3 id="login_header">Library Management System Login</h3> 
       </div>
       <br>
       <br>
       <div class="login_details">
        <label for="username">Username:</label>
        <br>
        <input type="text" placeholder="Username" name="username" required>
        <br>
        <br>
        <div class="password-container">
        <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Password"  required>
            <i id="passwordToggle" class="fas fa-eye-slash password-icon" onclick="togglePasswordVisibility()" aria-label="Toggle Password Visibility"></i>
        </div>
        <br>
        <div class="error-message"><?= $errorMessage ?></div>
        <br>
        <button type="submit" id="submit_user_details">Log in</button>
        <br>
        <br>
        <input type="reset" id="reset_form" placeholder="Reset password" value="Reset form">
        <br>
        <br>
        <button type="text" name="forget_password" id="forget_password" placeholder="Forgot password" value="Forgot password"><a href="reset.php">Forgot password</a></button>

       </div>
       <br>
       <div>
        <button type="button"><a class="reference_home" href="index.php">Home</a></button>
       </div>
    </form>
    <script>
        function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var passwordToggle = document.getElementById("passwordToggle");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.classList.remove("fa-eye-slash");
        passwordToggle.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        passwordToggle.classList.remove("fa-eye");
        passwordToggle.classList.add("fa-eye-slash");
    }
}

    </script>
    <br>

</body>
</html>
