<?php
require_once 'includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us - PM Smart Institute</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif;}
body{line-height:1.6;color:#333;background:#f5f5f5;}

/* Navbar */
nav{background:#007BFF;color:#fff;padding:15px;display:flex;justify-content:space-between;align-items:center;}
nav a{color:#fff;text-decoration:none;margin:0 15px;font-weight:bold;}
nav a:hover{text-decoration:underline;}

/* About Section */
.about{padding:50px 20px;}
.about h1{color:#007BFF;margin-bottom:20px;text-align:center;}
.about p{max-width:800px;margin:0 auto 20px auto;text-align:center;}

/* Vision/Mission */
.vision-mission{display:flex;flex-wrap:wrap;justify-content:center;gap:20px;margin-top:30px;}
.card{background:#fff;padding:20px;border-radius:8px;width:250px;box-shadow:0 0 10px rgba(0,0,0,0.1);}
.card h3{color:#007BFF;margin-bottom:10px;}

/* Footer */
footer{background:#007BFF;color:#fff;text-align:center;padding:20px;margin-top:40px;}
footer a{color:#fff;text-decoration:none;margin:0 10px;}
footer a:hover{text-decoration:underline;}

/* Responsive */
@media(max-width:768px){
    .vision-mission{flex-direction:column;align-items:center;}
}
</style>
</head>
<body>

<!-- Navbar -->
<nav>
    <div class="logo">PM Smart</div>
    <div class="menu">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="courses.php">Courses</a>
        <a href="contact.php">Contact</a>
    </div>
</nav>

<!-- About Section -->
<section class="about">
    <h1>About PM Smart Institute</h1>
    <p>PM Smart Institute is dedicated to providing quality education in PHP, MySQL, Frontend Development, and real-world projects. We focus on skill-building, practical knowledge, and career guidance.</p>
    <p>Our mission is to empower students with hands-on experience and make them job-ready in the IT industry.</p>

    <div class="vision-mission">
        <div class="card">
            <h3>Our Vision</h3>
            <p>To become a leading institute in practical IT education, helping students achieve their career goals.</p>
