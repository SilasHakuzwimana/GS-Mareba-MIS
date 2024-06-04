<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Book</title>
    <!-- Add your CSS file for styling -->
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/book.png">
    <style>
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
        .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        }
        .header1{
            position: relative;top: 15px;
            text-decoration: none;
            color: black;
        }
        a{
            text-decoration: none;
            color: black;
        }

        .form-group {
        margin-bottom: 15px;
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
        }

        button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-top: 10px;
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
        #librarian_dashboard{
        background-color: cadetblue;
        text-align: center;
        text-decoration: none;
        height:50px;
        }
        h2{
            text-align:center;
            background-color:cadetblue;
            color:white;
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
    </style>
</head>
<body>
    <div id="librarian_dashboard">
        <h2 class="header1">Librarian Book Registration</h2>
        <h4><a href="librarian_management_page.php">Back to dashboard</a></h4>
    </div><br><br>
    <div class="container">
        <h2>Register Book</h2>
        <form action="process_register_book.php" method="POST">
            <div class="form-group">
                <label for="Book_title">Book Title:</label>
                <input type="text" id="Book_title" name="Book_title" required>
            </div><br><br>
            <div class="form-group">
                <label for="Book_code">Book Code:</label>
                <input type="text" id="Book_code" name="Book_code" required>
            </div><br><br>
            <button type="submit">Register</button>
        </form>
    </div>

    <footer id="librarian_dashboard_footer">
    <p id="gsmareba_paragraph">School librarian &copy;&nbsp;<span id="copyright-year"></span>&nbsp;All right reserved!</p>
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
