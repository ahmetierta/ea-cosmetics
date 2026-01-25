<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "config/db.php";   
require "models/User.php";
require "services/AuthValidator.php";
require "services/RememberMe.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

$login = trim($_POST["login"] ?? "");
$password = $_POST["password"] ?? "";
$remember = !empty($_POST["remember"]);

$data = [
    "login" => $login,
    "password" => $password
];

$error = AuthValidator::validateLogin($data);
if ($error) {
    $_SESSION["auth_error"] = $error;
    header("Location: login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$userModel = new User($conn);

$user = $userModel->findByLoginRow($login);  

if (!$user || !password_verify($password, $user["password_hash"])) {
    $_SESSION["auth_error"] = "Wrong email/username or password";
    header("Location: login.php");
    exit;
}

session_regenerate_id(true);

$_SESSION["user_id"] = (int)$user["id"];
$_SESSION["username"] = $user["username"];
$_SESSION["role"] = $user["role"];

if ($remember) {
    $rememberService = new RememberMe($userModel);
    $rememberService->issue((int)$user["id"]);
}

if ($user["role"] === "admin") {
    header("Location: admin/dashboard.php");
    exit;
}

header("Location: index.php");
exit;
