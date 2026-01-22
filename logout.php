<?php 
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
require "config/db.php";

if(isset($_COOKIE['remember_token'])){
    $tokenHash = hash("sha256", $_COOKIE["remember_token"]);
    $stmt = $pdo->prepare("DELETE FROM user_tokens WHERE token_hash = ?");
    $stmt->execute([$tokenHash]);

    setcookie("remember_token" , "", time() -3600, "/");
}

session_unset();
session_destroy();

header("Location: index.php");
exit;