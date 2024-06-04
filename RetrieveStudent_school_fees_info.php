<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_mis_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Define the SQL query to fetch student records
$sql = "SELECT Record_id, Student_Names, Student_id, Student_Level, Term1_1, Term1_2, Total_1, Term2_1, Term2_2, Total_2, Term3_1, Term3_2, Total_3, General_total FROM studentrecords";
$result = $conn->query($sql);

//queries to search student pattern
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Define the SQL query to fetch student records
$sqlSearch = "SELECT Record_id, Student_Names, Student_id, Student_Level, Term1_1, Term1_2, Total_1, Term2_1, Term2_2, Total_2, Term3_1, Term3_2, Total_3, General_total 
        FROM studentrecords 
        WHERE Student_Names LIKE ? OR Student_id LIKE ? OR Student_Level LIKE ?";
$stmt = $conn->prepare($sqlSearch);
$search_param = "%" . $search . "%";
$stmt->bind_param("sss", $search_param, $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link rel="icon" href="images/Student_fees.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .container {
            width: 120%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2{
            font-size: 20px;
            background-color: cadetblue;
            color: white;
            text-align: center;
            text-decoration: none;
            height: 60px;
            position: relative;top: 20px;

        }
        a{
            text-align: center;
            text-decoration: none;
            color:white;
        }
        .actions {
            display: flex;
            gap: 10px; /* Add space between buttons */
        }
        .action-btn {
            padding: 5px 10px;
            color:white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        button{
            background-color:black;
            color:white;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            box-sizing: border-box;
        }
        .search-container input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .search-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        h4{
            background-color: burlywood;
            height: 40px;
            text-align: center;
            text-decoration: none;
            position: relative;top: 0px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Records</h2>
    <h4><a href="accountant_management_dashboard.php">Back to dashboard</a></h4>
    <br><br>
    <div class="search-container">
        <form action="RetrieveStudent_school_fees_info.php" method="post">
            <input type="text" name="search" placeholder="Search by name or StudentID" value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Search">
        </form>
    </div>
    <table>
        <tr>
            <th>Record ID</th>
            <th>Student Names</th>
            <th>Student ID</th>
            <th>Student Level</th>
            <th>Term 1 part 1</th>
            <th>Term 1 part 2</th>
            <th>Total 1</th>
            <th>Term 2 part 1</th>
            <th>Term 2 part 2</th>
            <th>Total 2</th>
            <th>Term 3 part 1</th>
            <th>Term 3 part 2</th>
            <th>Total 3</th>
            <th>General Total</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["Record_id"] . "</td>
                        <td>" . $row["Student_Names"] . "</td>
                        <td>" . $row["Student_id"] . "</td>
                        <td>" . $row["Student_Level"] . "</td>
                        <td>" . $row["Term1_1"] . "</td>
                        <td>" . $row["Term1_2"] . "</td>
                        <td>" . $row["Total_1"] . "</td>
                        <td>" . $row["Term2_1"] . "</td>
                        <td>" . $row["Term2_2"] . "</td>
                        <td>" . $row["Total_2"] . "</td>
                        <td>" . $row["Term3_1"] . "</td>
                        <td>" . $row["Term3_2"] . "</td>
                        <td>" . $row["Total_3"] . "</td>
                        <td>" . $row["General_total"] . "</td>
                        <td class='actions'>
                        <button><a href='edit_student.php?Record_id=" . $row["Record_id"] . "' class='action-btn edit-btn'>Update</a> </button>
                        <button><a href='delete_student.php?Record_id=" . $row["Record_id"] . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></button>
                    </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='13'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
