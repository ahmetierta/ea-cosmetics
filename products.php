<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA - Products</title>
    <link rel="icon" href="img/logo1.png">
    <link rel="stylesheet" href="style2.css">
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
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes sale">
            <img src="img/prod-shad1.png" alt="Eyeshadow Palette">
            <h3>Dreamy Eyeshadow Palette</h3>
            <p class="product-category">Eyes & Brows • Sale</p>
            <p class="product-price"><span class="old-price">€19.90</span> €14.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>
        <div class="product-card" data-category="eyes">
            <img src="img/prod-brow1.png" alt="Brow Pencil">
            <h3>Perfect Brow Pencil</h3>
            <p class="product-category">Eyes & Brows</p>
            <p class="product-price">€9.90</p>
        </div>

    </section>
    <div class="pagination" id="pagination"></div>

    </main>

    <?php include 'includes/footer.php'; ?>

    
</body>
</html>