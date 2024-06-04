<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $student_level = $_POST['student_level'];
    $term1_1 = $_POST['term1_1'];
    $term1_2 = $_POST['term1_2'];
    $term2_1 = $_POST['term2_1'];
    $term2_2 = $_POST['term2_2'];
    $term3_1 = $_POST['term3_1'];
    $term3_2 = $_POST['term3_2'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school_mis_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the call to the stored procedure
    $stmt = $conn->prepare("CALL AddStudent(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdddddd", $student_name, $student_level, $term1_1, $term1_2, $term2_1, $term2_2, $term3_1, $term3_2);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New student added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>