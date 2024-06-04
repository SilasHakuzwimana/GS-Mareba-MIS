<?php
include 'db_connection.php';

// Check if form is submitted with Book_title and Book_code
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Book_title']) && isset($_POST['Book_code'])) {
    $book_title = $_POST['Book_title'];
    $book_code = $_POST['Book_code'];
    $registered_at = date("Y-m-d H:i:s"); // Get current date and time

    // Insert the book record
    $sql = "INSERT INTO bookrecords (Book_title, Book_code, RegisteredAt) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $book_title, $book_code, $registered_at);

    if ($stmt->execute()) {
        echo "Book registered successfully";
    } else {
        echo "Error registering book: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
