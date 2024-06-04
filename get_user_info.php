<?php
session_start();
include 'db_connection.php';

// Check if MIS_userID is set in the session
if (isset($_SESSION['MIS_userID'])) {
    $mis_user_id = $_SESSION['MIS_userID'];

    // Prepare and execute the SQL query
    $sql = "SELECT Username, Email FROM school_mis_users_table WHERE MIS_userID = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $mis_user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user information is retrieved successfully
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Return user information as JSON data
            echo json_encode($row);
        } else {
            echo json_encode(array('error' => 'User not found'));
        }

        // Close the statement and the database connection
        $stmt->close();
    } else {
        echo json_encode(array('error' => 'SQL preparation failed: ' . $conn->error));
    }
    $conn->close();
} else {
    echo json_encode(array('error' => 'MIS_userID not set in session'));
}
?>
