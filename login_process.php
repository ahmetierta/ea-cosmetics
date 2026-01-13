<?php 
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
require "config/db.php";

if($_SERVER["REQUEST_METHOD"] != "POST"){
    header("Location: login.php");
    exit;
}

$login = trim($_POST["login"] ?? "");
$password = $_POST["password"] ?? "";

if($login === "" || $password===""){
    $_SESSION["auth_error"] = "Please fill all fields.";
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT id,username, password_hash,role FROM users WHERE email = ? OR username = ? LIMIT 1");
$stmt ->execute([$login,$login]);
$user = $stmt ->fetch(PDO::FETCH_ASSOC);

if(!$user){
    $_SESSION["auth_error"] = "Wrong email/username or password";
    header("Location: login.php");
    exit;
}
if(!password_verify($password, $user["password_hash"])){
    $_SESSION["auth_error"] = "Wrong email/username or password";
    header("Location: login.php");
    exit;
}

$_SESSION["user_id"] = (int)$user["id"];
$_SESSION["username"] = $user["username"];
$_SESSION["role"] = $user["role"];

if($user["role"] === "admin"){
    header("Location: admin/dashboard.php");
    exit;
}

header("Location: index.php");
exit;
