<?php 
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<header class="header">
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="Logo">
        </a>
    </div>

    <div class="nav-right">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact us</a>
        <?php if (!empty($_SESSION["user_id"])): ?>
        <?php if (($_SESSION["role"] ?? "") === "admin") : ?>
            <a href="admin/dashboard.php">Dashboard</a>
            <?php endif; ?>
            <a href= "logout.php">Logout</a>
            <?php else: ?>
        <a href="login.php">
            <img src="img/acc.png" alt="Account" title="Account">
        </a>
        <?php endif; ?>
    </div>
</header>
