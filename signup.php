<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA - Sign Up</title>
    <link rel="icon" href="img/logo1.png">
    <link rel="stylesheet" href="menufooter.css">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
    <div class="signup">
        <form action="register.php" method="POST" id="registerForm">
            <h1>CREATE AN ACCOUNT</h1>
            <label>Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <label>Surname</label>
            <input type="text" name="surname" id="surname" placeholder="Enter your surname">
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <label>Username</label>
            <input type="text" name="username" id="username" placeholder="Enter your username">
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" id="confirmpassword" placeholder="Confirm your password">
            <button type="submit" class="signup-button">Sign up</button>
            <a href="login.php" style="text-align: center; color: #C14279;"><b>Already have an account?</b></a>
        </form>
        <?php
        if (!empty($_SESSION["auth_error"])) {
            echo '<p style="color:#b3135d;text-align:center;margin-top:10px;">'
            . htmlspecialchars($_SESSION["auth_error"]) .
        '</p>';
        unset($_SESSION["auth_error"]);
        }
        ?>

        </div>
    </div>
    <script src="signup.js?v=2" defer></script>
</body>
</html>