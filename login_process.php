<?php 
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
require "config/db.php";

if($_SERVER["REQUEST_METHOD"] !== "POST"){
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

if(!$user || !password_verify($password , $user["password_hash"])){
    $_SESSION["auth_error"] = "Wrong email/username or password";
    header("Location: login.php");
    exit;
}

$_SESSION["user_id"] = (int)$user["id"];
$_SESSION["username"] = $user["username"];
$_SESSION["role"] = $user["role"];

if(!empty($_POST["remember"])){
    $token = bin2hex(random_bytes(32));
    $tokenHash = hash("sha256",$token);

    $expiresSeconds = 60 * 60 * 24 * 30;
    $expiresAt = date("Y-m-d H:i:s", time() + $expiresSeconds);

    $del = $pdo->prepare("DELETE FROM user_tokens WHERE user_id = ?");
    $del->execute([$user["id"]]);

    $ins = $pdo->prepare("INSERT INTO user_tokens (user_id,token_hash,expires_at)VALUES(? ,?, ?)");
    $ins->execute([$user["id"],$tokenHash, $expiresAt]);
    setcookie(
        "remember_token",
        $token,
        [
            "expires" => time() + expiresSeconds,
            "path" => "/",
            "secure" => false,
            "httponly" => true,
        ]
    );
}
if($user["role"] === "admin"){
    header("Location: admin/dashboard.php");
    exit;
}

header("Location: index.php");
exit;
