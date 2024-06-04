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
    <link rel="icon" href="images/update_book.png">
    <style>
    .container {
width: 50%;
margin: 50px auto;
padding: 20px;
border: 1px solid #ccc;
border-radius: 5px;
background-color: #f9f9f9;
}

h2 {
text-align: center;
margin-bottom: 20px;
}

.form-group {
margin-bottom: 20px;
}

label {
display: block;
font-weight: bold;
}

input[type="text"] {
width: 100%;
padding: 10px;
border: 1px solid #ccc;
border-radius: 3px;
box-sizing: border-box;
}

button[type="submit"] {
display: block;
width: 100%;
padding: 10px;
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
a {
text-decoration: none;
color: #007bff;
}

a:hover {
text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Update Book</h2>
        <h4><a href="library_all_books_data.php">Back to book data</a></h4>
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
