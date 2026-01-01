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
        <?php 
            include 'products-data.php';
            
            foreach($products as $p){
                $category = htmlspecialchars($p['category']);
                $name = htmlspecialchars($p['name']);
                $img = htmlspecialchars($p['img']);
                $alt = htmlspecialchars($p['alt']);

                $price = number_format((float)$p['price'],2);
                $sale = $p['sale_price'] !== null ? number_format((float)$p['sale_price'], 2) :null;
        ?>
            <div class="product-card" data-category="<?php echo $category; ?>">
                <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($alt); ?>">
                <h3><?php echo $name ?></h3>
                <?php 
                    $label = "Products";
                    if(str_contains($p['category'],'eyes') || str_contains($p['category'],'brows')) $label = "Eyes & Brows";
                    if(str_contains($p['category'],'face')) $label = "Face";
                    if(str_contains($p['category'],'lips')) $label = "Lips";
                    if(str_contains($p['category'],'brushes') || str_contains($p['category'],'accessories')) $label = "Brushes & Accessories";
                    if(str_contains($p['category'],'sale')) $label .= " • Sale";
                ?>
                <p class="product-category"><?php echo htmlspecialchars($label); ?></p>

                <p class="product-price">
                    <?php if($sale !== null) { ?>
                        <span class="old-price">€<?php echo $price; ?></span> €<?php echo $sale; ?>
                    <?php } else { ?>
                        €<?php echo $price; ?>
                    <?php } ?>
                </p>
            </div>
            <?php } ?>
    </section>
    <div class="pagination" id="pagination"></div>

    </main>
    <script src="products.js" defer></script>
    <?php include 'includes/footer.php'; ?>

    
</body>
</html>