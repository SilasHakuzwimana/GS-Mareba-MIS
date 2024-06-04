<?php
include 'db_connection.php';

// Initialize empty $row array to avoid undefined array key errors
$row = [
    'Record_id' => '',
    'Student_Names' => '',
    'student_level' => '',
    'Term1_1' => '',
    'Term1_2' => '',
    'Term2_1' => '',
    'Term2_2' => '',
    'Term3_1' => '',
    'Term3_2' => ''
];
// Success message variable
$success_message = '';

// Fetch the student record if a GET request is made with a Record_id
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['Record_id'])) {
    $record_id = $_GET['Record_id'];

    // Fetch the student record
    $sql = "SELECT * FROM StudentRecords WHERE Record_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $record_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found";
        exit;
    }

    $stmt->close();
}

// Update the student record if a POST request is made
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Record_id'])) {
    $record_id = $_POST['Record_id'];
    $student_name = $_POST['student_name'];
    $student_level = $_POST['student_level'];
    $term1_1 = $_POST['term1_1'];
    $term1_2 = $_POST['term1_2'];
    $term2_1 = $_POST['term2_1'];
    $term2_2 = $_POST['term2_2'];
    $term3_1 = $_POST['term3_1'];
    $term3_2 = $_POST['term3_2'];

    $sql = "UPDATE StudentRecords SET Student_Names = ?, student_level = ?, Term1_1 = ?, Term1_2 = ?, Term2_1 = ?, Term2_2 = ?, Term3_1 = ?, Term3_2 = ? WHERE Record_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssddddddi", $student_name, $student_level, $term1_1, $term1_2, $term2_1, $term2_2, $term3_1, $term3_2, $record_id);

    if ($stmt->execute()) {
        $success_message = "Student record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="icon" href="images/edit_student.png">
    <style>
        .form-container{
            background-color:whitesmoke;
            position:relative;left:350px;
            border:2px black solid;
            margin:10px;
            padding:10px;
            width:500px;
            text-align:center;
            font-weight:bold;
        }
        .header{
            background-color:cadetblue;
            color: white;
            height: 50px;
            position: relative;top: 10px;
        }
        #librarian_dashboard{
            background-color: cadetblue;
            text-align: center;
            color: white;
            text-decoration: none;
        }
        .submit-btn {
            width: 50%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

    .submit-btn:hover {
           background-color: #0056b3;
        }
        form{
            font-weight:bold;
        }
        input[type="number"]{
            width: 200px;
            height: 40px;
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        } 
    input[type="text"]{
            width: 300px;
            height: 30px;
            font-size: 20px;
        } 
    label{
            font-weight: bold;
            font-size: 20px;
        }
        #librarian_dashboard_footer{
            background-color: cornflowerblue;
            color: white;
            text-align: center;
            position: relative;top: 30px;
            height: 50px;
        }
#gsmareba_paragraph{
            position: relative;top: 20px;
            color: white;
        }
        h4,a{
            background-color: burlywood;
            height: 40px;
            text-align: center;
            text-decoration: none;
            position: relative;top: 0px;
        }
    </style>
</head>
<body>
    <div>
        <?php echo $success_message; ?>
    </div>
    <div id="librarian_dashboard">
        <h2 class="header">Accountant Editing Dashboard</h2>
    </div>
<div class="form-container">
    <form action="edit_student.php" method="post">
        <div id="librarian_dashboard">
        <h2 class="header">Edit a Student</h2>
        <h4><a href="RetrieveStudent_school_fees_info.php">Back</a></h4>
    </div><br><br>
        <input type="hidden" name="Record_id" value="<?php echo htmlspecialchars($row['Record_id']); ?>">

        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" value="<?php echo htmlspecialchars($row['Student_Names']); ?>" required>
        </div><br><br>

        <div class="form-group">
            <label for="student_level">Student Level:</label>
            <select id="student_level" name="student_level" required>
            <option value="Nursery" <?php if(isset($row['Student_Level']) && $row['Student_Level'] == 'Nursery') echo 'selected'; ?>>Nursery</option>
            <option value="Lower Primary" <?php if(isset($row['Student_Level']) && $row['Student_Level'] == 'Lower Primary') echo 'selected'; ?>>Lower Primary</option>
            <option value="Upper Primary" <?php if(isset($row['Student_Level']) && $row['Student_Level'] == 'Upper Primary') echo 'selected'; ?>>Upper Primary</option>
            <option value="Lower Secondary" <?php if(isset($row['Student_Level']) && $row['Student_Level'] == 'Lower Secondary') echo 'selected'; ?>>Lower Secondary</option>
            <option value="Upper Secondary" <?php if(isset($row['Student_Level']) && $row['Student_Level'] == 'Upper Secondary') echo 'selected'; ?>>Upper Secondary</option>
            <option value="BDC" <?php if(isset($row['Student_Level']) && $row['Student_Level'] == 'BDC') echo 'selected'; ?>>BDC</option>
            <option value="PLT" <?php if(isset($row['Student_Level']) && $row['Student_Level'] == 'PLT') echo 'selected'; ?>>PLT</option>
            </select>
        </div><br><br>

        <div class="form-group">
            <label for="term1_1">Term 1 Score 1:</label>
            <input type="number" step="0.01" id="term1_1" name="term1_1" value="<?php echo htmlspecialchars($row['Term1_1']); ?>" required>
        </div><br><br>

        <div class="form-group">
            <label for="term1_2">Term 1 Score 2:</label>
            <input type="number" step="0.01" id="term1_2" name="term1_2" value="<?php echo htmlspecialchars($row['Term1_2']); ?>" required>
        </div><br><br>

        <div class="form-group">
            <label for="term2_1">Term 2 Score 1:</label>
            <input type="number" step="0.01" id="term2_1" name="term2_1" value="<?php echo htmlspecialchars($row['Term2_1']); ?>" required>
        </div><br><br>

        <div class="form-group">
            <label for="term2_2">Term 2 Score 2:</label>
            <input type="number" step="0.01" id="term2_2" name="term2_2" value="<?php echo htmlspecialchars($row['Term2_2']); ?>" required>
        </div><br><br>

        <div class="form-group">
            <label for="term3_1">Term 3 Score 1:</label>
            <input type="number" step="0.01" id="term3_1" name="term3_1" value="<?php echo htmlspecialchars($row['Term3_1']); ?>" required>
        </div><br><br>

        <div class="form-group">
            <label for="term3_2">Term 3 Score 2:</label>
            <input type="number" step="0.01" id="term3_2" name="term3_2" value="<?php echo htmlspecialchars($row['Term3_2']); ?>" required>
        </div><br><br>

        <input type="submit" value="Update Student Records" class="submit-btn"><br><br>
    </form>
</div>
<footer id="librarian_dashboard_footer">
    <p id="gsmareba_paragraph">School accountant &copy;&nbsp;<span id="copyright-year"></span>&nbsp;All right reserved!</p>
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
