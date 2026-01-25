<?php
session_start();

require "config/db.php";    
require "models/User.php";
require "services/RememberMe.php";

if (!empty($_SESSION["user_id"])) {
    $db = new Database();
    $conn = $db->getConnection();
    $user = new User($conn);

    $user->deleteTokensByUser((int)$_SESSION["user_id"]);
}

RememberMe::clear();

session_destroy();

header("Location: index.php");
exit;
