<?php include('db_connection.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="icon" href="pass.png">

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }

    .reset-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        box-sizing: border-box;
        }

    h1 {
        text-align: center;
        color: #333;
        }

    label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
     }

    button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
     }

    button:hover {
        background-color: #45a049;
        }

    .back {
        text-align: center;
        margin-top: 10px;
        }

    .back a {
        text-decoration: none;
        color: #333;
        }
    </style>
</head>
<body>
    <div class="reset-form">
        <h1>Password Reset</h1>
        <form action="reset_password1.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email address" required>

            <button type="submit" name="reset_password">Reset Password</button>
        </form>
        <p class="back"><a href="login_user.php">Back to Login</a></p>
    </div>
</body>
</html>
