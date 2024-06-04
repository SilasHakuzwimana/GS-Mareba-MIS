<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All library resources</title>
    <link rel="icon" href="images/book.png">
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
                color: black;
                width: 100px;
                height: 50px;
                font-size: 25px;
            }
            h2{
                font-size: 40px;
                position: relative;top: 10px;
            }
            .container {
            width: 80%;
            margin: 20px auto;
            }

            h2 {
            text-align: center;
            }

            table {
            width: 100%;
            border-collapse: collapse;
            }

            th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            }

            th {
            background-color: #f2f2f2;
            }

            tr:hover {
            background-color: #f5f5f5;
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
    <nav>
        <div id="all_library_dashboard">
            <h2>All library resources</h2>
            <h4><a href="adminpage.php">Back to dashboard</a></h4>
        </div>
    </nav>
    <div class="container">
        <h2>Book Information</h2>
        <table>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Code</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
            <?php
            include 'db_connection.php';

            $sql = "SELECT * FROM bookrecords";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Book_record_id"] . "</td>";
                    echo "<td>" . $row["Book_title"] . "</td>";
                    echo "<td>" . $row["Book_code"] . "</td>";
                    echo "<td>" . $row["RegisteredAt"] . "</td>";
                    echo "<td>";
                    echo "<a href='update_book.php?Book_record_id=" . $row['Book_record_id'] . "'>Update</a> | ";
                    echo "<a href='delete_book.php?Book_record_id=" . $row['Book_record_id'] . "' onclick=\"return confirm('Are you sure you want to delete this book?')\">Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No books found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>

</body>
</html>