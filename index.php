<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Airline Reservation System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Airline Reservation System</h1>
        <nav>
            <a href="about.php">About</a>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            <?php else: ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<section class="banner">
    <img src="images/flight1.jpg" alt="Airline Banner" style="width:100%; height:600px; object-fit:cover;">
</section>

<section class="container" style="text-align:center; margin-top:30px;">
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="flight_class.php" class="btn">Book a Flight</a>
        <a href="passengers.php" class="btn">View My Bookings</a>
    <?php else: ?>
        <a href="register.php" class="btn">Register</a>
        <a href="login.php" class="btn">Login</a>
    <?php endif; ?>
</section>

<!-- About Us Section -->
<section id="about" class="container" style="text-align:center; margin-top:50px;">
    <h2>About Us</h2>
    <p>Book your flights easily with our airline reservation system. Login to view and book flights securely.</p>
</section>

<!-- Footer -->
<footer style="text-align:center; padding:20px; background:#333; color:#fff; margin-top:50px;">
    &copy; <?= date('Y') ?> Airline Reservation System. All Rights Reserved.
</footer>

</body>
</html>
