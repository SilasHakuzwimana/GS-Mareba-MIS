<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GS Mareba TSS - Home</title>
    <link rel="icon" href="images/home.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        nav {
            background-color: #555;
            padding: 10px 0;
            text-align: center;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
        }
        nav a:hover {
            background-color: #444;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .hero {
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }
        .hero h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 40px;
        }
        .section h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .section p {
            margin-bottom: 20px;
        }
        .section ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: relative; top:30px;
            width: 100%;
            bottom: 0;
            height:40px;
        }
        #librarian_dashboard_footer {
            background-color: cornflowerblue;
            color: white;
            text-align: center;
            position: relative; top: 40px;
            height: 50px;
        }
        #gsmareba_paragraph {
            position: relative; top: 20px;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to GS Mareba TSS</h1>
    </header>

    <nav>
        <a href="#about">About</a>
        <a href="#programs">Programs</a>
        <a href="#contact">Contact</a>
        <a href="index.php">Back</a>
    </nav>

    <div class="container">
        <section id="about" class="section">
            <h2>About Us</h2>
            <p>GS Mareba TSS is dedicated to providing high-quality education.</p>
        </section>

        <section id="programs" class="section">
            <h2>Our Programs</h2>
            <ul>
                <li>Nursery Education</li>
                <li>Primary Education</li>
                <li>Advanced Level Education</li>
                <li>Technical and Vocational Education and Training (TVET)</li>
            </ul>
        </section>

        <section id="contact" class="section">
            <h2>Contact Us</h2>
            <p>If you have any questions or inquiries, feel free to contact us.</p>
            <p><b>Phone number:+250788768417</b></p>
            <p><b>Email:gsmareba2018@gmail.com</b></p>
        </section>
    </div>
<br>
<br>
<footer id="librarian_dashboard_footer">
        <p id="gsmareba_paragraph">GS Mareba TSS MIS &copy;<span id="current-year"></span> All right reserved!</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentYear = new Date().getFullYear();
            document.getElementById('current-year').textContent = currentYear;
        });
</body>
</html>
