<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA - Sign Up</title>
    <link rel="icon" href="img/logo1.png">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
    <div class="signup">
        <form action="#">
            <h1>CREATE AN ACCOUNT</h1>
            <label>Name</label>
            <input type="text" name="" id="name" placeholder="Enter your name">
            <label>Surname</label>
            <input type="text" name="" id="surname" placeholder="Enter your surname">
            <label>Email</label>
            <input type="email" name="" id="email" placeholder="Enter your email">
            <label>Username</label>
            <input type="text" name="" id="username" placeholder="Enter your username">
            <label>Password</label>
            <input type="password" name="" id="password" placeholder="Enter your password">
            <label>Confirm Password</label>
            <input type="password" name="" id="confirmpassword" placeholder="Confirm your password">
            <button type="submit" class="signup-button">Sign up</button>
            <a href="login.html" style="text-align: center; color: #C14279;"><b>Already have an account?</b></a>
        </form>
        </div>
    </div>
    <script src="signup.js" defer></script>
</body>
</html>