<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Class</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="text-align:center; padding:50px; background:#f0f4ff;">
    <h2>Select Flight Class</h2>
    <form method="GET" action="flights.php">
        <select name="class" required style="padding:10px; font-size:16px;">
            <option value="">-- Select Class --</option>
            <option value="Economy">Economy</option>
            <option value="Business">Business</option>
        </select>
        <br><br>
        <button type="submit" class="btn">Show Flights</button>
    </form>
</body>
</html>
