<?php
require_once __DIR__ . "/../../services/Auth.php";
Auth::requireAdmin("../../login.php");

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../repositories/ProductRepository.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../dashboard.php?page=products");
    exit;
}

$id = (int)($_POST["id"] ?? 0);

if ($id > 0) {
    $db = new Database();
    $conn = $db->getConnection();
    $repo = new ProductRepository($conn);
    $repo->delete($id);
}

header("Location: ../dashboard.php?page=products");
exit;
