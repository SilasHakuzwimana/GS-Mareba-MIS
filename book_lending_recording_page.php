<?php
// Database connection details
$serverName = 'localhost';
$userName = 'root';
$passWord = '';
$database = 'school_mis_database';

// Create connection
$conn = new mysqli($serverName, $userName, $passWord, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $student_fullNames = $_POST['student_fullNames'];
    $student_class = $_POST['student_class'];
    $book_title = $_POST['book_title'];
    $book_code = $_POST['book_code'];
    $student_signature = $_POST['student_signature']; // Assuming it's a text field

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO book_data_recording (Student_names, Student_Class, Book_title, Book_code, Sign_1) VALUES (?, ?, ?, ?, ?)");

    // Check if prepare() was successful
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("sssss", $student_fullNames, $student_class, $book_title, $book_code, $student_signature);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lend a book</title>
    <link rel="icon" href="images/library-management-library-icons.jpg">
    <style>
        #all_library_dashboard{
            background-color: cadetblue;
            text-align: center;
            text-decoration: none;
            color: white;
            }
            a{
                text-decoration: none;
                text-align: center;
                background-color: wheat;
                font-size: 30px;
                color: black;
                width: 100px;
                height: 50px;
            }
            #lending_books{
                text-align: center;
                width: 550px;
                padding: 2px;
                margin: 2px;
            }
            .form-group{
                text-align: center;

            }
            input{
                display: block;
                position: relative;left: 10px;
                height: 30px;
                width: 95%;
                font-size: 20px;
            }
            form{
                position: relative;left: 400px;
                border: 2px black solid;
            }
            label{
                font-weight: bold;
                font-size: 20px;
            }
            h3{
                background-color: cadetblue;
                color: white;
                height: 60px;
                position: relative;top: 10px;
            }
            #librarian_dashboard_footer{
            background-color: cornflowerblue;
            color: white;
            text-align: center;
            position: relative;top: 70px;
            height: 50px;
             }
             #gsmareba_paragraph{
            position: relative;top: 20px;
            color: white;
            }
            .header{
            position: relative;top: 15px;
            text-decoration: none;
            color: black;
            }
            button{
                background-color: burlywood;
                padding: 2px 2px 0px;
                margin: 2px 2px 0px;
            }
            h2,h3{
                font-size: 25px;
                position: relative;top: 10px;
            }
    </style>
</head>
<body>
    <nav>
        <div id="all_library_dashboard">
            <h2>Lend a book</h2>
            <h4><a href="librarian_management_page.php">Back to dashboard</a></h4>
        </div>
    </nav>
    <form id="lending_books" action="book_lending_recording_page.php" method="post">
      <div class="form-group">
        <h3>Book lending form</h3>
     <label for="student_names">Full student names:</label>
     <input type="text" name="student_fullNames" id="student_fullNames" placeholder="Enter student full legal names" required>
      </div>
      <br>
      <div class="form-group">
        <label for="Class">Student Class:</label>
        <input type="text" name="student_class" id="student_class" placeholder="Enter student class" required>
      </div>
      <br>
      <div class="form-group">
        <label for="book_title">Book title:</label>
        <input type="text" name="book_title" id="book_title" placeholder="Enter book title" required>
      </div>
      <br>
      <div class="form-group">
        <label for="book_code">Book code:</label>
         <input type="text" name="book_code" id="book_code" placeholder="Enter book code" required>
    </div>
    <br>
    <div class="form-group">
        <label for="student_signature">Student signature:</label>
        <input type="text" name="student_signature" id="student_signature" placeholder="Enter student signature (1 for lending, 0 for not lending)" required>
    </div>
    <br>
    <br>
    <button type="reset">Reset the form</button>&nbsp;&nbsp;&nbsp;
    <button type="submit">Lend a book</button>
    </form>

    <!--adding footer-->
    <footer id="librarian_dashboard_footer">
    <p id="gsmareba_paragraph">G.S MAREBA TSS Library &copy;&nbsp;<span id="copyright-year"></span>&nbsp;All right reserved!</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Get the current year
        const currentYear = new Date().getFullYear();

        // Find the element in the HTML
        const yearElement = document.getElementById('copyright-year');

        // Set the text content of the element to the current year
        yearElement.textContent = currentYear;
        });
    </script>
</body>
</html>