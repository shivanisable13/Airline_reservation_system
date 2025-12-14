<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$flight_id = $_POST['flight_id'];
$price = $_POST['price'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Passenger Count</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="text-align:center;">
    <h2>Enter Number of Passengers</h2>
    <form method="POST" action="passenger_details.php">
        <input type="hidden" name="flight_id" value="<?= $flight_id ?>">
        <input type="hidden" name="price" value="<?= $price ?>">
        <input type="number" name="count" min="1" max="6" required style="padding:10px;">
        <br><br>
        <button type="submit" class="btn">Next</button>
    </form>
</body>
</html>
