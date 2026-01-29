<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . "/config/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contactus.php");
    exit;
}

$first = trim($_POST["first_name"] ?? "");
$last  = trim($_POST["last_name"] ?? "");
$email = trim($_POST["email"] ?? "");
$msg   = trim($_POST["message"] ?? "");

if ($first === "" || $last === "" || $email === "" || $msg === "") {
    $_SESSION["contact_error"] = "Please fill all fields.";
    header("Location: contactus.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["contact_error"] = "Email is not valid.";
    header("Location: contactus.php");
    exit;
}

$db = new Database();
$pdo = $db->getConnection();

$stmt = $pdo->prepare("INSERT INTO contact_messages (first_name, last_name, email, message)
                       VALUES (:f, :l, :e, :m)");
$stmt->execute([
    ":f" => $first,
    ":l" => $last,
    ":e" => $email,
    ":m" => $msg
]);

$_SESSION["contact_success"] = "Message sent successfully!";
header("Location: contactus.php");
exit;
