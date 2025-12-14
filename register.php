<?php
session_start();
include 'db.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows > 0){
        $error = "Email already exists!";
    } else {
        $conn->query("INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')");
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: lightblue;">
    <center>
<div class="container">
    <h2>Register</h2>
    <?php if(isset($error)){ echo "<p style='color:red;'>$error</p>"; } ?>
    
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="register">Register</button>
    </form>
  
    
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div></center>

</body>

</html>
