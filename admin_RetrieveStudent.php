<?php
$serverName = 'localhost';
$username = 'root';
$password = '';
$dbname = 'school_mis_database';
$conn = new mysqli($serverName, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Book_record_id, Date_out, Student_names, Student_Class, Book_title, Book_code, Sign_1, Date_in, Sign_2 FROM book_data_recording";
$sqlResult = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link rel="icon" href="images/viewStudent.png">
    <style>
        #all_library_dashboard {
            background-color: cadetblue;
            text-align: center;
            text-decoration: none;
            color: white;
        }
        a {
            text-decoration: none;
            text-align: center;
            background-color: wheat;
            color: black;
            width: 100px;
            height: 50px;
            font-size: 30px;
        }
        h2 {
            font-size: 25px;
            position: relative;top: 10px;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
        }
        table {
            border-collapse: collapse;
            border-color: blue;
            width: 98%;
            margin: 20px auto; 
        }
        table, th, td {
            border: 1.5px solid black !important;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            background-color: cadetblue;
            color: white;
        }
        h1 {
            color: white;
            font-family: 'Times New Roman', Times, serif;
        }
        .hom {
            text-decoration: none;
            background-color: black !important;
            color: white !important;
            font-weight: bolder;
            float: right;
        }
        .search {
            position: relative;
            left: 60px;
            align-items: center;
        }
        input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 5px;
        }
        .search1 {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: blue;
            color: white;
            cursor: pointer;
        }
        .searching {
            width: 600px;
        }
        #library_admin_footer{
            background-color: cornflowerblue;
            color: white;
            text-align: center;
            position: relative;top: 200px;
            height: 50px;
        }
        #library_admin_footerID{
            position: relative;top: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <div id="all_library_dashboard">
            <h2>Retrieve Borrowed Student</h2>
            <h4><a href="adminpage.php">Back to Dashboard</a></h4>
        </div>
    </nav>
    <br>
    <form action="RetrieveStudent.php" method="POST" class="search">
        <input type="text" name="search_query" class="searching" placeholder="Search a student..." required>
        <button type="submit" class="search1">Search</button>
    </form>
    <table border="2">
        <tr>
            <th>Book Record ID</th>
            <th>Date Out</th>
            <th>Student Names</th>
            <th>Student Class</th>
            <th>Book Title</th>
            <th>Book Code</th>
            <th>Signature 1 <br> (Is he/she borrowed a book?)</th>
            <th>Date In</th>
            <th>Signature 2 <br>(Is he/she returned the book?)</th>
            <th>Action</th>
        </tr>
        <?php
        if (isset($_POST['search_query'])) {
            $search_query = $conn->real_escape_string($_POST['search_query']);
            $sql_query = "SELECT Book_record_id, Date_out, Student_names, Student_Class, Book_title, Book_code, Sign_1, Date_in, Sign_2 
                          FROM book_data_recording 
                          WHERE Student_names LIKE '%$search_query%' 
                          OR Student_Class LIKE '%$search_query%' 
                          OR Book_title LIKE '%$search_query%' 
                          OR Book_code LIKE '%$search_query%'";
            $sqlResult = $conn->query($sql_query);
            if ($sqlResult === false) {
                die("Error in query: " . $conn->error . " | Query: " . $sql_query);
            }
        }
        if ($sqlResult->num_rows > 0) {
            while ($row = $sqlResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Book_record_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Date_out']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Student_names']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Student_Class']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Book_title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Book_code']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Sign_1']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Date_in']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Sign_2']) . "</td>";
                echo "<td>
                    <form method='post' action='RetrieveStudent.php'>
                        <input type='hidden' name='id' value='{$row['Book_record_id']}'>
                        <button type='submit' name='action' value='verify'>Verify</button> <br>
                        <button type='submit' name='action' value='unverify'>Unverify</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No results found.</td></tr>";
        }

        //updating a record script

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if 'id' and 'action' keys are set
  // Check if 'id' and 'action' keys are set
  if (isset($_POST['id']) && isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    // Initialize $stmt variable
    $stmt = null;

    if ($action == 'verify') {
        // Update record to verify and set Date_in
        $stmt = $conn->prepare("UPDATE book_data_recording SET Sign_2 = 'Verified', Date_in = NOW() WHERE Book_record_id = ?");
    } elseif ($action == 'unverify') {
        // Update record to unverify and set Date_in to NULL
        $stmt = $conn->prepare("UPDATE book_data_recording SET Sign_2 = 'Unverified', Date_in = NULL WHERE Book_record_id = ?");
    }

    // Check if $stmt is set and not null
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement.";
    }
} 

//else {
  //  echo "ID or action not provided.";
//}
        
        }
        $conn->close();
        ?>
    </table>
    <footer id="library_admin_footer">
    <p id="library_admin_footerID">Borrowed Students &copy;&nbsp;<span id="copyright-year"></span>&nbsp;All right reserved!</p>
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
