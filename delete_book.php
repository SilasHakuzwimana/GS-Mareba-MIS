<?php
include 'db_connection.php';

// Check if Book_record_id is provided in the URL
if(isset($_GET['Book_record_id'])) {
    $book_record_id = $_GET['Book_record_id'];

    // Fetch the book record
    $sql = "SELECT * FROM bookrecords WHERE Book_record_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_record_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Display form to update book record
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Book</title>
            <!-- Add your CSS file for styling -->
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <div class="container">
                <h2>Update Book</h2>
                <form action="process_update_book.php" method="POST">
                    <input type="hidden" name="Book_record_id" value="<?php echo $row['Book_record_id']; ?>">
                    <div class="form-group">
                        <label for="Book_title">Book Title:</label>
                        <input type="text" id="Book_title" name="Book_title" value="<?php echo $row['Book_title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Book_code">Book Code:</label>
                        <input type="text" id="Book_code" name="Book_code" value="<?php echo $row['Book_code']; ?>" required>
                    </div>
                    <button type="submit">Update</button>
                </form>
                <br>
                <a href="delete_book.php?Book_record_id=<?php echo $row['Book_record_id']; ?>" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Book record not found";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Book record ID not provided";
}
?>
