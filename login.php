<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA - Log In</title>
    <link rel="icon" href="img/logo1.png">
    <link rel="stylesheet" href="style1.css">
    <script src="signup.js"></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
    <div class="signup">
        <form action="#">
            <h1>LOG IN</h1>
            <label>Email</label>
            <input type="email" name="" id="email" placeholder="Enter your email">
            <label>Password</label>
            <input type="password" name="" id="password" placeholder="Enter your password">
            <button type="submit" class="signup-button" onclick="showAlert()">Log In</button>
            <a href="signup.php" style="text-align: center; color: #C14279;"><b>Don’t have an account?</b></a>
        </form>
        </div>
    </div>
    
</body>
</html>