<?php
session_start();

require "config/db.php";       
require "models/User.php";
require "services/AuthValidator.php"; 

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: signup.php");
    exit;
}

$name     = trim($_POST["name"] ?? "");
$surname  = trim($_POST["surname"] ?? "");
$email    = trim($_POST["email"] ?? "");
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";
$confirm  = $_POST["confirm_password"] ?? "";

$error = AuthValidator::validateRegister([
    "name" => $name,
    "surname" => $surname,
    "email" => $email,
    "username" => $username,
    "password" => $password,
    "confirm_password" => $confirm
]);

if ($error) {
    $_SESSION["auth_error"] = $error;
    header("Location: signup.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

if ($user->existsEmailOrUsername($email, $username)) {
    $_SESSION["auth_error"] = "Email or username already exists";
    header("Location: signup.php");
    exit;
}

if ($user->register($name, $surname, $email, $username, $password)) {
    header("Location: login.php");
    exit;
}

$_SESSION["auth_error"] = "Error registering user!";
header("Location: signup.php");
exit;
