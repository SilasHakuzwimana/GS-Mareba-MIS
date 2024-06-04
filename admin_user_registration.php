<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your database password
$dbname = "school_mis_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to validate password strength
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = sanitizeInput($_POST["fullName"]);
    $nationalID = sanitizeInput($_POST["nationalID"]);
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $userProfile = sanitizeInput($_POST["user_profile"]);
    $phone = sanitizeInput($_POST["phone"]);
    $password = sanitizeInput($_POST["password"]);
    $confirmPassword = sanitizeInput($_POST["confirmPassword"]);

    // Validate input
    $errors = [];
    if (empty($fullName) || empty($nationalID) || empty($username) || empty($email) || empty($userProfile) || empty($phone) || empty($password) || empty($confirmPassword)) {
        $errors[] = "All fields are required.";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (!preg_match("/^\d{16}$/", $nationalID)) {
        $errors[] = "National ID must be 16 digits.";
    }
    if (!preg_match("/^\+?\d{10,15}$/", $phone)) {
        $errors[] = "Invalid phone number.";
    }

    // Password strength validation
    $passwordError = validatePasswordStrength($password);
    if ($passwordError) {
        $errors[] = $passwordError;
    }

    // Check if the user already exists in the database
    $stmt = $conn->prepare("SELECT * FROM school_mis_users_table WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Username already exists. Please choose a different username.";
    }
    $stmt->close();

    if (empty($errors)) {
        // Proceed with inserting the user into the database
        // Hash the password using Argon2 algorithm
        $options = [
            'memory_cost' => 1<<17, // 128 MB
            'time_cost' => 4,
            'threads' => 3,
        ];
        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID, $options);

        // Insert user into database table
        $stmt = $conn->prepare("INSERT INTO school_mis_users_table (Full_Names, ID_number, Username, Email, User_profile, Phone_number, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fullName, $nationalID, $username, $email, $userProfile, $phone, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
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
    <title>User Registration</title>
    <link rel="stylesheet" href="registration_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/user_registration.jpg">
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    background-color: black;
    color: burlywood;
    height: 50px;
    padding-top: 5px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width:98%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="password"] {
    position: relative;
}

.password-icon {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

.error-message {
    color: red;
    margin-top: 5px;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: none;
    border-radius: 3px;
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

button[type="submit"]:focus {
    outline: none;
}
#admin_back{
    text-decoration: none;
    text-align: center;
    color: rgb(247, 245, 245);
    background-color: #0056b3;
    position: relative;left: 100px;
    height: 90px;
    width: 98%;
}
    .form-group1 {
                margin-bottom: 1em;
                }
    .form-group1 label {
                display: block;
                margin-bottom: 0.5em;
                }
    .form-group1 select {
                width: 100%;
                padding: 0.5em;
                box-sizing: border-box;
                }
    .form-group2 {
                margin-bottom: 1em;
                position: relative;
                }
    .form-group2 label {
                display: block;
                margin-bottom: 0.5em;
                }
    .form-group2 input {
                width: 100%;
                padding: 0.5em;
                box-sizing: border-box;
                }
    .password-container {
                position: relative;
                }
    .password-icon {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                }
    </style>
</head>
<body>
    <div class="header">
    <h2 class="register_header">User registration</h2>
    </div>
    <form id="registrationForm" action="admin_user_registration.php" method="post">
        <div class="form-group">
            <label for="fullName">Full names:</label>
            <input type="text" id="fullName" name="fullName" placeholder="Enter user legal full names" required>
        </div>
        <div class="form-group">
            <label for="nationalID">ID Number:</label>
            <input type="text" id="nationalID" name="nationalID" maxlength="16" placeholder="Enter 16 digits ID numbers" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter user email address" required>
        </div>
        <div class="form-group1">
            <label for="user_profile">User Profile:</label>
            <select id="user_profile" name="user_profile" required>
                <option value="" disabled selected>Select user profile</option>
                <option value="Administrator">Administrator</option>
                <option value="Librarian">Librarian</option>
                <option value="Accountant">Accountant</option>
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone number:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter user phone number with country code" maxlength="15" required>
        </div>
        <div class="form-group password-container">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <i id="passwordToggle" class="fas fa-eye-slash password-icon" onclick="togglePasswordVisibility('password', 'passwordToggle')"></i>
            <div id="passwordStrengthMessage" class="error-message"></div>
        </div>
        <div class="form-group password-container">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            <i id="passwordToggle1" class="fas fa-eye-slash password-icon" onclick="togglePasswordVisibility('confirmPassword', 'passwordToggle1')"></i>
            <div id="passwordMatchMessage" class="error-message"></div>
        </div>
        <div id="passwordMatchMessage" class="error-message"></div>
        <button type="reset">Reset the form</button>
        <button type="submit">Register</button><br>
        <a id="admin_back" href="adminpage.php">Back to admin page</a>
    </form>
    <script>
        function togglePasswordVisibility(passwordFieldId, toggleIconId) {
            const passwordField = document.getElementById(passwordFieldId);
            const passwordToggle = document.getElementById(toggleIconId);
            const isPasswordVisible = passwordField.type === 'text';
            
            if (isPasswordVisible) {
                passwordField.type = 'password';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'text';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }

        function validatePasswordStrength(password) {
            const minLength = 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /[0-9]/.test(password);
            const hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            if (password.length < minLength) {
                return `Password must be at least ${minLength} characters long.`;
            }
            if (!hasUpperCase) {
                return "Password must contain at least one uppercase letter.";
            }
            if (!hasLowerCase) {
                return "Password must contain at least one lowercase letter.";
            }
            if (!hasNumbers) {
                return "Password must contain at least one number.";
            }
            if (!hasSpecialChars) {
                return "Password must contain at least one special character.";
            }
            return "";
        }

        function validatePasswordMatch() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                return "Passwords do not match.";
            } else {
                return "";
            }
        }

        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            const password = document.getElementById("password").value;
            const passwordStrengthMessage = document.getElementById("passwordStrengthMessage");
            const passwordMatchMessage = document.getElementById("passwordMatchMessage");

            const strengthError = validatePasswordStrength(password);
            const matchError = validatePasswordMatch();

            passwordStrengthMessage.textContent = strengthError;
            passwordMatchMessage.textContent = matchError;

            if (strengthError || matchError) {
                event.preventDefault();
            }
        });
    </script>
    </script>
</body>
</html>
