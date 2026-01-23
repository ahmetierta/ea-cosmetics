<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA - Log In</title>
    <link rel="icon" href="img/logo1.png">
    <link rel="stylesheet" href="menufooter.css">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
    <div class="signup">
        <form action="login_process.php" method="POST">
            <h1>LOG IN</h1>
            <label>Email or Username</label>
            <input type="text" name="login" id="login" placeholder="Enter your email or username">
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password">
            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember" id="remember">
                    <span>Remember me</span>
                </label>
            </div>
            <button type="submit" class="signup-button">Log In</button>
            <a href="signup.php" style="text-align: center; color: #C14279;"><b>Don’t have an account?</b></a>
        </form>

        <?php
        if(!empty($_SESSION["auth_error"])){
            echo '<p style="color: #b3135d;text-align:center;margin-top:10px;">'.htmlspecialchars($_SESSION["auth_error"]).'</p>';
            unset($_SESSION["auth_error"]);
        }
        ?>
        </div>
    </div>
    
</body>
</html>