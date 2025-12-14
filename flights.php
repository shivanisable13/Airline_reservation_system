<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$class = $_GET['class'] ?? 'Economy';
$flights = $conn->query("SELECT * FROM flights WHERE class='$class'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Flights</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container" style="text-align:center;">
    <h2>Available <?= htmlspecialchars($class) ?> Flights</h2>
    <table border="1" cellpadding="10" style="margin:auto; border-collapse:collapse;">
        <tr>
            <th>Flight Name</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php while($row = $flights->fetch_assoc()){ ?>
        <tr>
            <td><?= $row['flight_name'] ?></td>
            <td><?= $row['source'] ?></td>
            <td><?= $row['destination'] ?></td>
            <td><?= $row['date'] ?></td>
            <td>$<?= $row['price'] ?></td>
            <td>
                <form method="POST" action="passenger_count.php">
                    <input type="hidden" name="flight_id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                    <button type="submit" class="btn">Book Now</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
