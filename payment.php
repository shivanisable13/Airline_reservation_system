<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// If passenger details were submitted from passenger_details.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['card_number'])) {
    // Store passenger details temporarily in session
    $_SESSION['flight_id'] = $_POST['flight_id'];
    $_SESSION['total_amount'] = $_POST['total_amount'];
    $_SESSION['passenger_name'] = $_POST['passenger_name'];
    $_SESSION['passenger_age'] = $_POST['passenger_age'];
    $_SESSION['passenger_gender'] = $_POST['passenger_gender'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: #f0f4ff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: white;
            margin: 60px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            text-align: center;
        }

        input {
            padding: 10px;
            width: 80%;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #0056b3;
        }

        h2 {
            color: #007bff;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
// Step 2: Process Payment & Insert Data
if (isset($_POST['card_number'])) {
    $user_id = $_SESSION['user_id'];
    $flight_id = $_SESSION['flight_id'];
    $total_amount = $_SESSION['total_amount'];
    $names = $_SESSION['passenger_name'];
    $ages = $_SESSION['passenger_age'];
    $genders = $_SESSION['passenger_gender'];

    // Simulate card validation (no real payment gateway here)
    $card_number = $_POST['card_number'];
    $card_name = $_POST['card_name'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];

    if (strlen($card_number) < 12 || strlen($cvv) < 3) {
        echo "<div class='container'><p style='color:red;'>Invalid card details. Please go back and try again.</p></div>";
        exit;
    }

    // Insert booking
    $conn->query("INSERT INTO bookings (user_id, flight_id, total_amount, payment_status) 
                  VALUES ('$user_id','$flight_id','$total_amount','Paid')");
    $booking_id = $conn->insert_id;

    // Insert passengers
    for ($i = 0; $i < count($names); $i++) {
        $name = $names[$i];
        $age = $ages[$i];
        $gender = $genders[$i];
        $conn->query("INSERT INTO passengers (booking_id, name, age, gender) 
                      VALUES ('$booking_id','$name','$age','$gender')");
    }

    // Clear temporary session data
    unset($_SESSION['flight_id'], $_SESSION['total_amount'], $_SESSION['passenger_name'], $_SESSION['passenger_age'], $_SESSION['passenger_gender']);

    // Fetch flight details for confirmation
    $flight = $conn->query("SELECT * FROM flights WHERE id='$flight_id'")->fetch_assoc();

    echo "
    <div class='container'>
        <h2>Payment Successful!</h2>
        <p class='success'>Thank you, your booking is confirmed.</p>
        <h3>Booking Details</h3>
        <p><strong>Flight:</strong> {$flight['flight_name']}</p>
        <p><strong>From:</strong> {$flight['source']} → <strong>To:</strong> {$flight['destination']}</p>
        <p><strong>Date:</strong> {$flight['date']}</p>
        <p><strong>Total Paid:</strong> $$total_amount</p>
        <h4>Passengers:</h4>
        <ul style='list-style:none; padding:0;'>
    ";

    $pquery = $conn->query("SELECT name, age, gender FROM passengers WHERE booking_id='$booking_id'");
    while ($p = $pquery->fetch_assoc()) {
        echo "<li>{$p['name']} ({$p['age']} yrs, {$p['gender']})</li>";
    }

    echo "
        </ul>
        <a href='passengers.php' class='btn'>View My Bookings</a>
        <a href='index.php' class='btn'>Back to Home</a>
    </div>
    ";
    exit;
}
?>

<!-- Step 1: Show Payment Form -->
<div class="container">
    <h2>Payment Details</h2>
    <p><strong>Total Amount to Pay:</strong> $<?= $_SESSION['total_amount'] ?></p>
    <form method="POST">
        <input type="text" name="card_name" placeholder="Cardholder Name" required><br>
        <input type="text" name="card_number" placeholder="Card Number" maxlength="16" required><br>
        <input type="text" name="expiry" placeholder="Expiry (MM/YY)" required><br>
        <input type="password" name="cvv" placeholder="CVV" maxlength="3" required><br>
        <button type="submit">Pay Now</button>
    </form>
</div>

</body>
</html>
