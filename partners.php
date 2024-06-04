<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Institution Partners</title>
    <link rel="icon" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    }

header {
    background-color: #4CAF50;
    color: white;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    margin: 0;
}

nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

nav ul li {
    display: inline;
    margin: 0 10px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.partner-section {
    background-color: #fff;
    margin: 20px auto;
    padding: 20px;
    max-width: 800px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.partner-section h2 {
    text-align: center;
    color: #333;
}

.partner-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.partner-logo {
    width: 150px;
    height: auto;
    margin-bottom: 15px;
}

.partner-link {
    color: #4CAF50;
    text-decoration: none;
    font-weight: bold;
}

.partner-link i {
    margin-left: 5px;
}

footer {
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}

@media (min-width: 600px) {
    .partner-content {
        flex-direction: row;
        text-align: left;
    }

    .partner-logo {
        margin-right: 20px;
    }
}
a{
    text-decoration:none;
}
h1{
    color:black;
}

    </style>
</head>
<body>
    <header>
        <h1>Our Esteemed Partners</h1><br>
        <nav>
            <ul>
                <li><a href="#reb">REB</a></li>
                <li><a href="#nesa">NESA</a></li>
                <li><a href="#mineduc">MINEDUC</a></li>
                <li><a href="index.php">Back</a></li>
            </ul>
        </nav>
    </header>
    
    <section id="reb" class="partner-section">
        <h2>Rwanda Education Board (REB)</h2>
        <div class="partner-content">
            <img src="images/reb_logo.png" alt="REB Logo" class="partner-logo">
            <p>
                The Rwanda Education Board (REB) is responsible for ensuring quality education in Rwanda. It manages curriculum development, teacher education, and national examinations.
            </p>
            <a href="https://www.reb.gov.rw" target="_blank" class="partner-link">Learn more <i class="fas fa-external-link-alt"></i></a>
        </div>
    </section>
    
    <section id="nesa" class="partner-section">
        <h2>National Examination and School Inspection Authority (NESA)</h2>
        <div class="partner-content">
            <img src="images/nesa_logo.png" alt="NESA Logo" class="partner-logo">
            <p>
                NESA ensures the proper administration of national examinations and supervises school inspections to maintain high standards in education across the country.
            </p>
            <a href="https://nesa.gov.rw" target="_blank" class="partner-link">Learn more <i class="fas fa-external-link-alt"></i></a>
        </div>
    </section>
    
    <section id="mineduc" class="partner-section">
        <h2>Ministry of Education (MINEDUC)</h2>
        <div class="partner-content">
            <img src="images/mineduc_logo.png" alt="MINEDUC Logo" class="partner-logo">
            <p>
                The Ministry of Education oversees the education sector in Rwanda. It formulates educational policies and ensures their implementation to improve access to quality education.
            </p>
            <a href="https://mineduc.gov.rw" target="_blank" class="partner-link">Learn more <i class="fas fa-external-link-alt"></i></a>
        </div>
    </section>
    
    <footer>
        <p>GS Mareba TSS MIS &copy; <span id="current-year"></span> All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentYear = new Date().getFullYear();
            document.getElementById('current-year').textContent = currentYear;
        });
    </script>
</body>
</html>
