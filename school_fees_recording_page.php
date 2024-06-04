<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Paid School Fees</title>
    <link rel="icon" href="images/school_fees_icon.png">
    <style>
    #form_id{
            position: relative;left: 350px;top: 60px;
            text-align: center;
            font-weight: bold;
            border: 2px black solid;
            width: 400px;
        }
        form{
            position: relative;left: 350px;
        }
    #librarian_dashboard_footer{
            background-color: cornflowerblue;
            color: white;
            text-align: center;
            position: relative;top: 100px;
            height: 50px;
        }
    #gsmareba_paragraph{
            position: relative;top: 20px;
            color: white;
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
    #librarian_dashboard{
            background-color: cadetblue;
            text-align: center;
            color: white;
            text-decoration: none;
        }
    .header{
            background-color:cadetblue;
            color: white;
            height: 50px;
            position: relative;top: 10px;
        }
    .header1{
            background-color: #0056b3;
            color: white;
            height: 40px;
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
    .reset_btn{
            width: 50%;
            padding: 10px;
            background-color: cadetblue;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease; 
        }
    .reset_btn:hover{
            background-color: #0056b3;
        } 
    h4,a{
        background-color: burlywood;
        height: 40px;
        text-align: center;
        text-decoration: none;
        position: relative;top: 10px;
    } 
    option,select{
        width:220px;
        height:30px;
    }  

    </style>
</head>
<body>
    <div id="librarian_dashboard">
        <h2 class="header">Register a student</h2>
        <h4><a href="accountant_management_dashboard.php">Back to dashboard</a></h4>
    </div>
<form action="add_student.php" id="form_id" method="post">
    <h2 class="header1">Register a student</h2>
    <label for="student_name">Student Name:</label>
    <input type="text" id="student_name" name="student_name" required><br><br>
    <div class="form-group">
            <label for="student_level">Student Level:</label>
            <select id="student_level" name="student_level" required>
                <option value="select student level">Select</option>
                <option value="Nursery">Nursery</option>
                <option value="Lowerprimary">Lower Primary</option>
                <option value="Upperprimary">Upper Primary</option>
                <option value="Lowersecondary">Lower Secondary</option>
                <option value="Uppersecondary">Upper Secondary</option>
                <option value="BDC">BDC</option>
                <option value="PLT">PLT</option>
            </select>
        </div><br><br>

    <label for="term1_1">Term 1 part1:</label>
    <input type="number" step="0.01" id="term1_1" name="term1_1" required><br><br>

    <label for="term1_2">Term 1 part 2:</label>
    <input type="number" step="0.01" id="term1_2" name="term1_2" required><br><br>

    <label for="term2_1">Term 2 part 1:</label>
    <input type="number" step="0.01" id="term2_1" name="term2_1" required><br><br>

    <label for="term2_2">Term 2 part 2:</label>
    <input type="number" step="0.01" id="term2_2" name="term2_2" required><br><br>

    <label for="term3_1">Term 3 part 1:</label>
    <input type="number" step="0.01" id="term3_1" name="term3_1" required><br><br>

    <label for="term3_2">Term 3 part 2:</label>
    <input type="number" step="0.01" id="term3_2" name="term3_2" required><br><br>

    <input type="submit" class="submit-btn" value="Submit"><br><br><input type="reset" class="reset_btn" value="Reset the form"><br><br>
</form>
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