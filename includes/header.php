<?php 
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require "config/db.php";

if(empty($_SESSION["user_id"]) && !empty($_COOKIE["remember_token"])){
    $tokenHash = hash("sha256", $_COOKIE["remember_token"]);

    $stmt = $pdo->prepare("
        SELECT u.id,u.username,u.role
        from user_tokens t
        JOIN users u ON u.id = t.user_id
        WHERE t.token_hash = ? AND t.expires_at > NOW()
        LIMIT 1
    ");
    $stmt->execute([$tokenHash]);
    $user = $stmt -> fetch(PDO::FETCH_ASSOC);

    if($user) {
        $_SESSION["user_id"] = (int)$user["id"];
        $_SESSION["username"]= $user["username"];
        $_SESSION["role"]= $user["role"];
    }else{
        setcookie("remember_token", "" , time() -3600, "/");
    }
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
            <?php if (($_SESSION["role"] ?? "") === "user") : ?>
            <a href="cart.php">
                <img src="img/basket.png" alt="Basket" title="Basket">
            </a>
            <?php endif; ?>

            <a href= "logout.php">Logout</a>
            <?php else: ?>
        <a href="login.php">
            <img src="img/acc.png" alt="Account" title="Account">
        </a>
        <?php endif; ?>
    </div>
</header>
