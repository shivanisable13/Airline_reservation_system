<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch all bookings for this user
$bookings = $conn->query("
    SELECT b.id AS booking_id, f.flight_name, f.source, f.destination, f.date, 
           b.total_amount, b.payment_status
    FROM bookings b
    JOIN flights f ON b.flight_id = f.id
    WHERE b.user_id = '$user_id'
    ORDER BY b.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef3f9;
            margin: 0;
            padding: 0;
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

        .container {
            width: 90%;
            margin: 30px auto;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        th {
            background: #007bff;
            color: white;
        }

        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin: 2px;
        }

        .btn-delete {
            background: #dc3545;
        }

        footer {
            text-align: center;
            padding: 15px;
            background: #333;
            color: #fff;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>Airline Reservation System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="flight_class.php">Book Flight</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</header>

<div class="container">
    <h2>My Bookings</h2>

    <?php if($bookings->num_rows > 0): ?>
        <table>
            <tr>
                <th>Flight</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Passengers</th>
                <th>Action</th>
            </tr>

            <?php while($b = $bookings->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($b['flight_name']) ?></td>
                    <td><?= htmlspecialchars($b['source']) ?></td>
                    <td><?= htmlspecialchars($b['destination']) ?></td>
                    <td><?= htmlspecialchars($b['date']) ?></td>
                    <td>$<?= htmlspecialchars($b['total_amount']) ?></td>
                    <td><?= htmlspecialchars($b['payment_status']) ?></td>
                    <td>
                        <?php
                        $booking_id = $b['booking_id'];
                        $pquery = $conn->query("SELECT name, age, gender FROM passengers WHERE booking_id='$booking_id'");
                        if($pquery->num_rows > 0){
                            echo "<ul style='list-style:none; padding:0;'>";
                            while($p = $pquery->fetch_assoc()){
                                echo "<li>{$p['name']} ({$p['age']} yrs, {$p['gender']})</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "No passengers found";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="delete_booking.php?id=<?= $b['booking_id'] ?>" class="btn btn-delete" onclick="return confirm('Cancel this booking?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No bookings found!</p>
    <?php endif; ?>
</div>

<footer>
    &copy; <?= date('Y') ?> Airline Reservation System. All Rights Reserved.
</footer>

</body>
</html>
