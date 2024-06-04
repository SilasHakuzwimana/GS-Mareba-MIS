<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM school_mis_users_table WHERE MIS_userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fullName = $_POST['full_name'];
    $idNumber = $_POST['id_number'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $profile = $_POST['profile'];
    $phoneNumber = $_POST['phone_number'];

    $sql = "UPDATE school_mis_users_table SET Full_Names = ?, ID_number = ?, Username = ?, Email = ?, User_profile = ?, Phone_number = ? WHERE MIS_userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $fullName, $idNumber, $username, $email, $profile, $phoneNumber, $id);
    $stmt->execute();

    header('Location: admin_accountant_details.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="icon" href="images/user_edit.png">
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.container {
    width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    width: 500px;
    position: relative;left: 350px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="email"] {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
}

button[type="submit"] {
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    align-self: center;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <h2>Edit User</h2>
    <form action="edit_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['MIS_userID']; ?>">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $user['Full_Names']; ?>" required><br>
        <label for="id_number">ID Number:</label>
        <input type="text" name="id_number" value="<?php echo $user['ID_number']; ?>" required><br>
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['Username']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['Email']; ?>" required><br>
        <label for="profile">Profile:</label>
        <input type="text" name="profile" value="<?php echo $user['User_profile']; ?>" required><br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $user['Phone_number']; ?>" required><br>
        <button type="submit">Update User</button>
    </form>
</body>
</html>
