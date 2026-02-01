<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EA – Contact Us</title>
<link rel="stylesheet" href="menufooter.css">
<link rel="stylesheet" href="contactus.css">
<link rel="icon" href="img/logo1.png">
<style>
    body{
    background-color: #F8D8E8;
    font-family: 'Verdana' , sans-serif;
}
</style>
</head>

<body>

<?php include 'includes/header.php'; ?>

<section class="hero">
    <img src="img/huda.png" alt="Hero Image">
    <h1>Contact Us</h1>
</section>

<section class="location-section">
  <h2>Visit EA-Cosmetics</h2>

  <div class="location-box">
    <div class="location-text">
      <h3>Inspired by EA-Cosmetics</h3>

      <p>
        Our beauty collections are inspired by global standards you love —
        featuring trends, shades, and formulas found at EA-Cosmetics.
      </p>

      <p>
        Discover premium makeup, skincare, and glow essentials
        trusted by millions worldwide.
      </p>

      <p><strong>Reference store:</strong> EA-Cosmetics</p>

      <a class="location-btn"
         href="https://www.google.com/maps/place/Sephora"
         target="_blank">Find EA-Cosmetics on Maps</a>
    </div>

    <div class="location-map">
      <iframe
        src="https://www.google.com/maps?q=Sephora&output=embed"
        width="100%" height="260"
        style="border:0; border-radius:18px;"
        allowfullscreen=""
        loading="lazy">
      </iframe>
    </div>
  </div>
</section>


<section class="contact">
    <h2>Let’s Start a Conversation</h2>
    <div class="contact-grid">
        <div class="contact-text">
            <h3><b>Ask how we can help you</b></h3>
            <p><b>Have questions about our products, orders, or collaborations?</b></p>
            <ul>
                <li><b>💄 Product inquiries</b></li>
                <li><b>📦 Order support</b></li>
                <li><b>🤝 Brand collaborations</b></li>
            </ul>
        </div>


        <form method="POST" action="contact_submit.php">
            <label>First Name</label>
            <input type="text" name="first_name" required>

            <label>Last Name</label>
            <input type="text" name="last_name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Message</label>
            <textarea name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>
        <?php if (!empty($_SESSION["contact_success"])): ?>
  <p style="font-weight:bold;color:green;">
    <?= htmlspecialchars($_SESSION["contact_success"]); ?>
  </p>
  <?php unset($_SESSION["contact_success"]); ?>
<?php endif; ?>

<?php if (!empty($_SESSION["contact_error"])): ?>
  <p style="font-weight:bold;color:red;">
    <?= htmlspecialchars($_SESSION["contact_error"]); ?>
  </p>
  <?php unset($_SESSION["contact_error"]); ?>
<?php endif; ?>

    </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
