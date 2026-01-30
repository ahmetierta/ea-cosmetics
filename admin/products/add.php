<?php
require_once __DIR__ . "/../../services/Auth.php";
Auth::requireAdmin("../../login.php");

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../repositories/ProductRepository.php";
require_once __DIR__ . "/../../models/Product.php";

$db = new Database();
$conn = $db->getConnection();
$repo = new ProductRepository($conn);

$error = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $image = trim($_POST["image"] ?? "");
    $alt = trim($_POST["alt"] ?? "");
    $desc = trim($_POST["description"] ?? "");
    $price = (float)($_POST["price"] ?? 0);
    $salePriceRaw = trim($_POST["sale_price"] ?? "");
    $salePrice = ($salePriceRaw === "") ? null : (float)$salePriceRaw;
    $qty = (int)($_POST["quantity"] ?? 0);

    if ($name === "" || $category === "" || $image === "" || $alt === "" || $desc === "") {
        $error = "Please fill all fields.";
    } else {
        $repo->insert(new Product(null, $name, $category, $image, $alt, $desc, $price, $salePrice, $qty));
        header("Location: ../dashboard.php?page=products");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Product</title>
  <link rel="stylesheet" href="../dashboard.css">
</head>
<body class="admin-body">

<div class="layout">
  <main class="content" style="max-width:900px;margin:0 auto;">
    <header class="topbar">
      <span>Add Product</span>
      <a class="btn-back" href="../dashboard.php?page=products">Go Back</a>
    </header>

    <div class="panel">
      <?php if ($error): ?>
        <div class="msg error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form class="form" method="POST" action="">
        <div>
          <label>Name</label>
          <input class="input" name="name" required>
        </div>

        <div>
          <label>Category</label>
          <input class="input" name="category" required>
        </div>

        <div>
          <label>Image path</label>
          <input class="input" name="image" required>
        </div>

        <div>
          <label>Alt text</label>
          <input class="input" name="alt" required>
        </div>

        <div class="full">
          <label>Description</label>
          <textarea class="input" name="description" rows="4" required></textarea>
        </div>

        <div>
          <label>Price</label>
          <input class="input" name="price" type="number" step="0.01" required>
        </div>

        <div>
          <label>Sale Price (optional)</label>
          <input class="input" name="sale_price" type="number" step="0.01" placeholder="Leave empty if no sale">
        </div>

        <div>
          <label>Quantity</label>
          <input class="input" name="quantity" type="number" required>
        </div>

        <div class="full">
          <button class="btn-primary" type="submit">Add Product</button>
        </div>
      </form>
    </div>
  </main>
</div>

</body>
</html>
