<?php
require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/repositories/ProductRepository.php";

$db = new Database();
$conn = $db->getConnection();

$repo = new ProductRepository($conn);
$products = $repo->getAll(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA - Products</title>
    <link rel="icon" href="img/logo1.png">
    <link rel="stylesheet" href="menufooter.css">
    <link rel="stylesheet" href="style2.css">
    <style>
        body{background:#FFF8FC !important;}
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
   <main>
    <section class="starti">
    <video class="hero-video" autoplay muted loop playsinline>
        <source src="img/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="explore-more">
        <h2 id="hero-title">Products</h2>
    </div>
</section>
    <section class="products-intro">
        <p>Your beauty essentials, thoughtfully selected to elevate your everyday glow.</p>
    </section>
    <section class="products-filters">
        <button class="category-card all-category" onclick="filterProducts('all')">
            All Products
        </button>
        <button class="category-card" onclick="filterProducts('eyes')">
            <img src="img/eyes.jpg" alt="eyes">
            <p>Eyes & Brows</p>
        </button>
        <button class="category-card" onclick="filterProducts('face')">
            <img src="img/face.png" alt="face">
            <p>Face</p>
        </button>
        <button class="category-card" onclick="filterProducts('lips')">
            <img src="img/lips.png" alt="lips">
            <p>Lips</p>
        </button>
        <button class="category-card" onclick="filterProducts('brushes')">
            <img src="img/brushes.png" alt="Brushes & Accessories">
            <p>Brushes & Accessories</p>
        </button>
        <button class="category-card all-category" style="color: red; background: rgba(255, 150, 160, 0.40); font-size: 25px; font-weight: 700; letter-spacing: 0.5px;"  onclick="filterProducts('sale')">
            SALE %
        </button>
    </section>

    <section class="products-grid" id="products-list">
        <?php foreach($products as $p):
    $category = htmlspecialchars($p["category"] ?? "all");
    $name = htmlspecialchars($p["name"] ?? "");
    $img = htmlspecialchars($p["image"] ?? "img/default-product.png");
    $alt = htmlspecialchars($p["alt"] ?? "Product");

    $price = number_format((float)$p["price"], 2);
    $sale  = ($p["sale_price"] !== null && $p["sale_price"] !== "")
        ? number_format((float)$p["sale_price"], 2)
        : null;
    ?>
    <a class="product-link" href="singleproduct.php?id=<?= (int)$p["id"] ?>">
    <div class="product-card" data-category="<?= $category ?>">
      <img src="<?= $img ?>" alt="<?= $alt ?>">
      <h3><?= $name ?></h3>

      <?php
        $label = "Products";
        if (strpos($category, "eyes") !== false) $label = "Eyes & Brows";
        if (strpos($category, "face") !== false) $label = "Face";
        if (strpos($category, "lips") !== false) $label = "Lips";
        if (strpos($category, "brushes") !== false) $label = "Brushes & Accessories";
        if (strpos($category, "sale") !== false) $label .= " • Sale";

      ?>
      <p class="product-category"><?= htmlspecialchars($label) ?></p>

      <p class="product-price">
        <?php if ($sale !== null): ?>
          <span class="old-price" style="text-decoration:line-through">€<?= $price ?></span> €<?= $sale ?>
        <?php else: ?>
          €<?= $price ?>
        <?php endif; ?>
      </p>
    </div>
    </a>
<?php endforeach; ?>
    </section>
    <div class="pagination" id="pagination"></div>
    </main>
    <div class="pink-line"></div>
    <script src="products.js" defer></script>
    <?php include 'includes/footer.php'; ?>

    
</body>
</html>