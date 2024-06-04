<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSMT Management Information System</title>
    <link rel="icon" href="images/library-management-library-icons.jpg">
    <link rel="stylesheet" href="styles.css">
    <style>
body{
        background-image: url(images/back.jpg);
    }

#listing_title{
    background-color: whitesmoke;
    color: green;
    display: inline;
    list-style: none;
    position: relative;left: 60px;
    font-size: 20px;
}
li{
    display: inline;
    flex-direction: row;
}
.home_list{
    position: relative;left: 100px;top: 5px;
    text-align: center;
    text-decoration: none;
    font-size: 20px;
}
.partners_list{
    position: relative;left: 300px;top: 5px;
    text-align: center;
    text-decoration: none;   
    font-size: 20px; 
}
.services_list{
    position: relative;left: 500px;top: 5px;
    text-align: center;
    text-decoration: none; 
    font-size: 20px; 
}
.login_list{
    position: relative;left: 900px;top: 5px;
    text-align: center;
    text-decoration: none; 
    color: black; 
    font-size: 20px;
}
#division_tag{
    text-align: center;
    margin-top: 20px;
    background-color: whitesmoke;
    color: #000;
    height: 60px;
    position: relative;top: 5px;
}
.home_list:hover{
    background-color: cadetblue;
    color: white;
    width: 200px;
    height: 100px;
}
.partners_list:hover{
    background-color: cadetblue;
    color: white;
    width: 60px;
    height: 40px;  
}
.services_list:hover{
    background-color: cadetblue;
    color: white;
    width: 60px;
    height: 40px;
}
.login_list:hover{
    background-color: cadetblue;
    color: white;
    width: 60px;
    height: 40px;
}
#library_footer{
    background-color: cornflowerblue;
    color: white;
    text-align: center;
    position: relative;top: 300px;bottom: 2px;
    height: 30px;
}
#library_footer_paragraph{
    position: relative;top: 340px;
    color: white;
    text-align: center;
}
#heading{
    background-color: slategray;
    color: white;
    font-size: 20px;
    height: 200px;
}
#school_logo{
    position: relative;left: 2px;top: 5px;
}
a{
    text-decoration:none;
    color:black;
}
#copyright-year{
    height:80px;
}

.nav_button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.nav_button:hover {
    background-color: darkblue;
}

.nav_button a {
    color: white;
    text-decoration: none;
}
    </style>
</head>
<body>
    <nav id="library_title">
        <div>
            <div id="heading">
            <h1> <img id="school_logo" src="images/Logo Mareba7.jpg" alt="gsmareba logo" width="180px" height="180px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GSMT Management Information System</h1>
            </div>
            <div id="division_tag">
        <button class="nav_button home_button"><a href="home_page.php">Home</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="nav_button partners_button"><a href="partners.php">Partners</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="nav_button services_button"><a href="services.php">Services</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="nav_button login_button"><a href="login_user.php">Log in</a></button>
    </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <footer id="library_footer">
    <p>G.S MAREBA TSS &copy;&nbsp;<span id="copyright-year"></span>&nbsp;All right reserved!</p>
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