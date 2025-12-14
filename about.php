<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Airline Reservation System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: #333;
        }

        header {
            background: #007bff;
            color: white;
            padding: 15px 0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            margin: auto;
        }

        header nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        .about-container {
            background-color: #fff;
            max-width: 900px;
            margin: 50px auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            text-align: center;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
            font-size: 16px;
            text-align: justify;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>Airline Reservation System</h1>
        <nav>
            <a href="index.php">Home</a>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            <?php else: ?>
                <a href="flights.php">Book a Flight</a>
                <a href="passengers.php">My Bookings</a>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<section class="about-container">
    <h2>About Our Airline Reservation System</h2>
    <p>
        Welcome to the <strong>Airline Reservation System</strong> — your one-stop platform to book, manage, 
        and review your flight journeys with ease. Our system is designed to provide passengers with a seamless 
        and secure experience when reserving flights online.
    </p>
    <p>
        We aim to simplify the booking process by providing a user-friendly interface where users can 
        register, search for available flights, make secure payments, and view their personal booking history.
    </p>
    <p>
        Whether you are traveling for business or leisure, our goal is to make your travel planning as smooth 
        as possible. With advanced features such as online booking, payment integration, and personal dashboards, 
        we bring convenience right to your fingertips.
    </p>
    <p>
        Our mission is to make air travel accessible, efficient, and transparent — connecting people and 
        destinations around the world safely and comfortably.
    </p>

    <a href="index.php" class="btn">Back to Home</a>
</section>

<footer>
    &copy; <?= date('Y') ?> Airline Reservation System. All Rights Reserved.
</footer>

</body>
</html>
