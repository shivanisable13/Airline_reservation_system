<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$count = $_POST['count'];
$flight_id = $_POST['flight_id'];
$price = $_POST['price'];
$total = $count * $price;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Passenger Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container" style="text-align:center;">
    <h2>Enter Passenger Details</h2>
    <form method="POST" action="payment.php">
        <input type="hidden" name="flight_id" value="<?= $flight_id ?>">
        <input type="hidden" name="total_amount" value="<?= $total ?>">
        <input type="hidden" name="count" value="<?= $count ?>">

        <?php for($i=1; $i<=$count; $i++){ ?>
            <div style="border:1px solid #ccc; margin:10px; padding:10px; border-radius:8px;">
                <h3>Passenger <?= $i ?></h3>
                <input type="text" name="passenger_name[]" placeholder="Full Name" required><br>
                <input type="number" name="passenger_age[]" placeholder="Age" required><br>
                <select name="passenger_gender[]" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        <?php } ?>
        <h3>Total Amount: $<?= $total ?></h3>
        <button type="submit" class="btn">Proceed to Payment</button>
    </form>
</div>
</body>
</html>
