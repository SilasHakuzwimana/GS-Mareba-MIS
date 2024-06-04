<?php
$serverName = 'localhost';
$username = 'root';
$password = '';
$dbname = 'school_mis_database';
$conn = new mysqli($serverName, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'verify') {
        // Update record to verify and set Date_in
        $stmt = $conn->prepare("UPDATE book_data_recording SET Sign_2 = 'Verified', Date_in = NOW() WHERE Book_record_id = ?");
    } elseif ($action == 'unverify') {
        // Update record to unverify and clear Date_in
        $stmt = $conn->prepare("UPDATE book_data_recording SET Sign_2 = 'Unverified', Date_in = NULL WHERE Book_record_id = ?");
    }

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
    header("Location: book_lending_recording_page.php");
    exit();
}
?>
