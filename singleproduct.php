<?php
require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/repositories/ProductRepository.php";

$db = new Database();
$conn = $db->getConnection();
$repo = new ProductRepository($conn);

$id = (int)($_GET["id"] ?? 0);
$product = ($id > 0) ? $repo->getById($id) : null;

if (!$product) {
    header("Location: products.php");
    exit;
}

$name = htmlspecialchars($product["name"] ?? "");
$category = htmlspecialchars($product["category"] ?? "all");
$image = htmlspecialchars($product["image"] ?? "img/default-product.png");
$alt = htmlspecialchars($product["alt"] ?? $name);
$description = htmlspecialchars($product["description"] ?? "");
$qty = (int)($product["quantity"] ?? 0);

$price = (float)($product["price"] ?? 0);
$salePriceRaw = $product["sale_price"] ?? null;
$salePrice = ($salePriceRaw !== null && $salePriceRaw !== "") ? (float)$salePriceRaw : null;

$priceFormatted = number_format($price, 2);
$saleFormatted = ($salePrice !== null) ? number_format($salePrice, 2) : null;

$label = "Products";
if (strpos($category, "eyes") !== false) $label = "Eyes & Brows";
if (strpos($category, "face") !== false) $label = "Face";
if (strpos($category, "lips") !== false) $label = "Lips";
if (strpos($category, "brushes") !== false) $label = "Brushes & Accessories";
if (strpos($category, "sale") !== false) $label .= " • Sale";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EA - <?= $name ?></title>
  <link rel="icon" href="img/logo1.png">
  <link rel="stylesheet" href="menufooter.css">
  <link rel="stylesheet" href="singleproduct.css">
  <style> body{background:#FFF8FC !important;} </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="sp-page">

  <div class="sp-breadcrumb">
    <a href="products.php">Products</a>
    <span>›</span>
    <span><?= $name ?></span>
  </div>

  <section class="sp-container">

    <div class="sp-left">
      <div class="sp-main-image">
        <img src="<?= $image ?>" alt="<?= $alt ?>">
      </div>
    </div>

    <div class="sp-right">
      <div class="sp-meta">
        <span class="sp-category"><?= htmlspecialchars($label) ?></span>
        <?php if (strpos($category, "sale") !== false): ?>
          <span class="sp-badge">SALE</span>
        <?php endif; ?>
      </div>

      <h1 class="sp-title"><?= $name ?></h1>

      <div class="sp-price">
        <?php if ($saleFormatted !== null): ?>
          <span class="sp-old">€<?= $priceFormatted ?></span>
          <span class="sp-new">€<?= $saleFormatted ?></span>
        <?php else: ?>
          <span class="sp-new">€<?= $priceFormatted ?></span>
        <?php endif; ?>
      </div>

      <div class="sp-stock <?= ($qty > 0) ? 'in' : 'out' ?>">
        <?= ($qty > 0) ? "In stock • {$qty} available" : "Out of stock" ?>
      </div>

      <?php if ($description !== ""): ?>
        <div class="sp-desc">
          <h3>Description</h3>
          <p><?= $description ?></p>
        </div>
      <?php endif; ?>

      <div class="sp-actions">
        <button class="sp-btn" type="button" <?= ($qty <= 0) ? "disabled" : "" ?>>
          Add to Bag
        </button>
        <a class="sp-back" href="products.php">← Back to Products</a>
      </div>

    </div>

  </section>

</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>
