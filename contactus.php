<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EA – Contact Us</title>
<link rel="stylesheet" href="menufooter.css">
<link rel="stylesheet" href="contactus.css">
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

<section class="help">
    <h2>How can we help?</h2>
    <div class="help-grid">
        <div class="help-item">
            <div class="help-circle"><img src="img/pink.png" alt=""></div>
            <p>Advertise</p>
        </div>
        <div class="help-item">
            <div class="help-circle"><img src="img/pink.png" alt=""></div>
            <p>Reporter / Media</p>
        </div>
        <div class="help-item">
            <div class="help-circle"><img src="img/pink.png" alt=""></div>
            <p>Contributor</p>
        </div>
        <div class="help-item">
            <div class="help-circle"><img src="img/pink.png" alt=""></div>
            <p>Write</p>
        </div>
        <div class="help-item">
            <div class="help-circle"><img src="img/pink.png" alt=""></div>
            <p>Have a Tip</p>
        </div>
        <div class="help-item">
            <div class="help-circle"><img src="img/pink.png" alt=""></div>
            <p>Company</p>
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
