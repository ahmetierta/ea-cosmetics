<?php 
session_start();
require "config/db.php";

if($_SERVER["REQUEST_METHOD"] != "POST"){
    header("Location: signup.php");
    exit;
}

$name = trim($_POST["name"] ?? "");
$surname = trim($_POST["surname"] ?? "");
$email = trim($_POST["email"] ?? "");
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";
$confirm = $_POST["confirm_password"] ?? "";

if($name=="" || $surname=="" || $email=="" || $username=="" || $password=="" || $confirm==""){
    $_SESSION["auth_error"] = "Please fill all fields.";
    header("Location: signup.php");
    exit;
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION["auth_error"] = "Email is not valid";
    header("Location: signup.php");
    exit;
}
if(strlen($password) < 8) {
    $_SESSION["auth_error"] = "Password must be at least 8 characters";
    header("Location: signup.php");
    exit;
}
if($password != $confirm){
    $_SESSION["auth_error"] = "Passwords do not match";
    header("Location: signup.php");
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ? LIMIT 1");
$stmt ->execute([$email,$username]);

if($stmt->fetch()){
    $_SESSION["auth_error"] = "Email or username already exists";
    header("Location: signup.php");
    exit;
}

$hash = password_hash($password , PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (name, surname, email, username, password_hash, role)
VALUES (?, ?, ?, ?, ?, 'user')");
$stmt->execute([$name, $surname, $email, $username, $hash]);

$_SESSION["user_id"] = $pdo->lastInsertId();
$_SESSION["username"] = $username;
$_SESSION["role"] = "user";

header("Location: index.php");
exit;
