<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System administrator</title>
    <link rel="stylesheet" href="adminpage_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/admin.jpg">
    <style>
        #library_admin_footer{
            background-color: cornflowerblue;
            color: white;
            text-align: center;
            position: relative;top: 30px;
            height: 50px;
        }
        #library_admin_footerID{
            position: relative;top: 20px;
        }
        #admin_user_registration{
        background-color: rgb(160, 164, 164);
        color: white;
        width: 230px;
        height: 570px;
        border: 2px black solid;
        text-align: center;
        text-decoration: none;
        font-size: 25px;
        text-decoration: none;
        list-style-type: none;

          }
          #user-info {
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: right;
            cursor: pointer; /* Add cursor pointer to indicate it's clickable */
        }
        #user-info .fa-user {
            font-size: 40px;
            vertical-align: middle;
        }
        #user-info span {
            vertical-align: middle;
            margin-left: 10px;
            color: white;
        }
        
        .register_list1, .register_list2, .register_list4, .register_list5, .register_list6, .register_list7 {
            list-style-type: none;
            color: white;
            text-decoration: none;
            font-size: 25px;
        }
        body{
        background-image: url(images/back.jpg);
        }
        .nav-button {
            background-color: cornflowerblue;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            display: block;
            margin: 10px auto;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;
        }
        .nav-button:hover {
            background-color: darkblue;
        }
</style>
</head>
<body>
    <nav>
        <div id="system_header"><h2>Management Information System Administrator Dashboard</h2></div>
        <div id="user-info">
            <i class="fas fa-user"></i> <!-- Font Awesome user icon -->
            <span id="Username"></span> <!-- Placeholder for username -->
            <span id="Email"></span> <!-- Placeholder for email -->
        </div>
        <br>
        <div id="admin_user_registration"><br>
        <a class="nav-button" href="admin_accountant_details.php">Dashboard</a><br>
            <a class="nav-button" href="admin_user_registration.php">User registration</a><br>
            <a class="nav-button" href="admin_library_all_books_data.php">View all books</a><br>
            <a class="nav-button" href="admin_RetrieveStudent.php">View borrowers</a><br>
            <a class="nav-button" href="admin_account_recording_info.php">Student school fees tracking</a><br>
            <a class="nav-button" href="index.php">Logout</a>
        </div>
    </nav>
    <footer id="library_admin_footer">
    <p id="library_admin_footerID">School MIS administrator &copy;&nbsp;<span id="copyright-year"></span>&nbsp;All right reserved!</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Get the current year
        const currentYear = new Date().getFullYear();

        // Find the element in the HTML
        const yearElement = document.getElementById('copyright-year');

        // Set the text content of the element to the current year
        yearElement.textContent = currentYear;

       // Fetch user information from the server
       fetch('get_user_info.php')
            .then(response => response.json())
            .then(data => {
                // Check if data is available
                if (data) {
                    // Update username and email elements
                    document.getElementById('username').textContent = data.Username;
                    document.getElementById('email').textContent = data.Email;
                }
            })
            .catch(error => console.error('Error fetching user information:', error));

            // Add click event listener to the profile icon
            document.getElementById('user-info').addEventListener('click', function() {
                fetch('get_user_info.php')
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        alert(`Username: ${data.Username}\nEmail: ${data.Email}`);
                    } else {
                        alert('No user information found.');
                    }
                })
                .catch(error => console.error('Error fetching user information:', error));
            });
        });
    </script>
</body>
</html>