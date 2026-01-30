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

<form method="POST">
  <label>Name</label><br>
  <input name="name" value="<?= htmlspecialchars($product["name"]) ?>" required><br><br>

  <label>Category</label><br>
  <input name="category" value="<?= htmlspecialchars($product["category"]) ?>" placeholder="eyes / face / lips / brushes / sale" required><br><br>

  <label>Image (path)</label><br>
  <input name="image" value="<?= htmlspecialchars($product["image"]) ?>" placeholder="img/prod-1.png" required><br><br>

  <label>Alt text</label><br>
  <input name="alt" value="<?= htmlspecialchars($product["alt"]) ?>" required><br><br>

  <label>Description</label><br>
  <textarea name="description" required><?= htmlspecialchars($product["description"]) ?></textarea><br><br>

  <label>Price</label><br>
  <input name="price" type="number" step="0.01" value="<?= htmlspecialchars($product["price"]) ?>" required><br><br>

  <label>Sale price (optional)</label><br>
  <input name="sale_price" type="number" step="0.01"
         value="<?= htmlspecialchars($product["sale_price"] ?? "") ?>"><br><br>

  <label>Quantity</label><br>
  <input name="quantity" type="number" value="<?= (int)$product["quantity"] ?>" required><br><br>

  <button type="submit">Save</button>
</form>
