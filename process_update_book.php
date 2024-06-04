<?php
include 'db_connection.php';

// Check if form is submitted with Book_record_id and updated data
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Book_record_id']) && isset($_POST['Book_title']) && isset($_POST['Book_code'])) {
    $book_record_id = $_POST['Book_record_id'];
    $book_title = $_POST['Book_title'];
    $book_code = $_POST['Book_code'];

    // Update the book record
    $sql = "UPDATE bookrecords SET Book_title = ?, Book_code = ? WHERE Book_record_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $book_title, $book_code, $book_record_id);

    if ($stmt->execute()) {
        echo "Book record updated successfully";
    } else {
        echo "Error updating book record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
