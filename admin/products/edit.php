<?php
require_once __DIR__ . "/../../services/Auth.php";
Auth::requireAdmin("../../login.php");

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../repositories/ProductRepository.php";

$db = new Database();
$conn = $db->getConnection();
$repo = new ProductRepository($conn);

$id = (int)($_GET["id"] ?? 0);
$product = $repo->getById($id);

if (!$product) {
    header("Location: ../dashboard.php?page=products");
    exit;
}

$error = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $image = trim($_POST["image"] ?? "");
    $alt = trim($_POST["alt"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $price = (float)($_POST["price"] ?? 0);
    $salePriceRaw = trim($_POST["sale_price"] ?? "");
    $salePrice = ($salePriceRaw === "") ? null : (float)$salePriceRaw;
    $quantity = (int)($_POST["quantity"] ?? 0);

    if ($name === "" || $category === "" || $image === "" || $alt === "" || $description === "") {
        $error = "Please fill all fields (sale price optional).";
    } else {
        $repo->update($id, $name, $category, $image, $alt, $description, $price, $salePrice, $quantity);
        header("Location: ../dashboard.php?page=products");
        exit;
    }
}
?>

<?php if ($error): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Product</title>
  <link rel="stylesheet" href="../dashboard.css">
</head>

<body class="admin-body">

<div class="layout">
  <main class="content" style="max-width:720px;margin:0 auto;">

    <header class="topbar topbar-wrap">
      <span>Edit Product</span>
      <a class="btn-back" href="../dashboard.php?page=products">← Go Back</a>
    </header>

    <div class="panel">
      <?php if ($error): ?>
        <div class="msg error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form class="form" method="POST" action="">

        <div>
          <label>Name</label>
          <input class="input" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div>
          <label>Category</label>
          <input class="input" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>
        </div>

        <div>
          <label>Image path</label>
          <input class="input" name="image" value="<?= htmlspecialchars($product['image']) ?>" required>
        </div>

        <div>
          <label>Alt text</label>
          <input class="input" name="alt" value="<?= htmlspecialchars($product['alt']) ?>" required>
        </div>

        <div class="full">
          <label>Description</label>
          <textarea class="input" name="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div>
          <label>Price</label>
          <input class="input" name="price" type="number" step="0.01"
                 value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>

        <div>
          <label>Sale Price (optional)</label>
          <input class="input" name="sale_price" type="number" step="0.01"
                 value="<?= htmlspecialchars($product['sale_price'] ?? '') ?>">
        </div>

        <div>
          <label>Quantity</label>
          <input class="input" name="quantity" type="number"
                 value="<?= (int)$product['quantity'] ?>" required>
        </div>

        <div class="full">
          <button class="btn-primary" type="submit">Save Changes</button>
        </div>

      </form>
    </div>
  </main>
</div>

</body>
</html>



