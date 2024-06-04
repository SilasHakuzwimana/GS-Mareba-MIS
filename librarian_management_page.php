<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Management System</title>
    <link rel="icon" href="images/librarian.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #librarian_dashboard {
            background-color: cadetblue;
            text-align: center;
            text-decoration: none;
        }
        #librarian_modification_page {
            background-color: whitesmoke;
            text-decoration: none;
            text-align: center;
            display: block;
            color: black;
            height: 50px;
            position: relative; top: 20px;
        }
        .librarian_navigation_bar {
            background-color: cadetblue;
            text-decoration: none;
            text-align: center;
            color: white;
            padding: 10px;
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
        li {
            background-color: whitesmoke;
            list-style-type: none;
            display: inline;
            text-align: center;
            position: relative; top: 20px;
            text-decoration: none;
            color: black;
            margin: 0 10px;
        }
        #librarian_dashboard_footer {
            background-color: cornflowerblue;
            color: white;
            text-align: center;
            position: relative; top: 390px;
            height: 50px;
        }
        #gsmareba_paragraph {
            position: relative; top: 20px;
            color: white;
        }
        .header {
            position: relative; top: 15px;
            text-decoration: none;
            color: black;
        }
        body{
        background-image: url(images/back.jpg);
        }
        a {
            text-decoration: none;
            color: black;
        }
        .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: slateblue;
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        position:relative;top:20px;
        cursor: pointer;
        margin-right: 10px; /* Adjust margin between buttons */
        }
        .button:hover{
            background-color:blue;
        }
    </style>
</head>

<body>
<body>
    <nav class="librarian_navigation_bar">
        <div id="librarian_dashboard">
            <h2 class="header">Librarian Management System Dashboard</h2>
        </div>
        <div id="user-info">
            <i class="fas fa-user"></i> <!-- Font Awesome user icon -->
            <span id="Username"></span> <!-- Placeholder for username -->
            <span id="Email"></span> <!-- Placeholder for email -->
        </div>
        <div id="librarian_modification_page">
        <!-- Button links -->
        <a href="library_all_books_record.php" class="button">Register a book</a>
        <a href="library_all_books_data.php" class="button">Library books</a>
        <a href="book_lending_recording_page.php" class="button">Lend a book</a>
        <a href="RetrieveStudent.php" class="button">Borrowers</a>
        <a href="index.php" class="button">Logout</a>
    </div>
    </nav>
    <footer id="librarian_dashboard_footer">
        <p id="gsmareba_paragraph">School librarian &copy;<span id="copyright-year"></span> All right reserved!</p>
    </footer>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current year
    const currentYear = new Date().getFullYear();
    document.getElementById('copyright-year').textContent = currentYear;

    // Fetch user information from the server
    fetch('get_user_info.php')
        .then(response => response.json())
        .then(data => {
            // Check if data is available
            if (data) {
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    // Update username and email elements
                    document.getElementById('username').textContent = data.Username;
                    document.getElementById('email').textContent = data.Email;
                }
            }
        })
        .catch(error => console.error('Error fetching user information:', error));

    // Add click event listener to the profile icon
    document.getElementById('user-info').addEventListener('click', function() {
        fetch('get_user_info.php')
            .then(response => response.json())
            .then(data => {
                if (data) {
                    if (data.error) {
                        alert(`Error: ${data.error}`);
                    } else {
                        alert(`Username: ${data.Username}\nEmail: ${data.Email}`);
                    }
                } else {
                    alert('No user information found.');
                }
            })
            .catch(error => console.error('Error fetching user information:', error));
    });
});
    </script>
</body>

</body>
</html>