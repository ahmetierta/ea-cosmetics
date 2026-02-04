<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION["user_id"]) || (($_SESSION["role"] ?? "") !== "admin")) {
        header("Location: ../login.php");
        exit;
    }

    require_once __DIR__ . "/../config/db.php";
    require_once __DIR__ . "/../models/User.php";

    $db = new Database();
    $conn = $db->getConnection();
    $userModel = new User($conn);

    $users = $userModel->getAllUsers();
    $page = $_GET["page"] ?? "users";
    $adminName = $_SESSION["username"] ?? "admin";

    $profileError = null;
    $profileSuccess = null;

    if(!empty($_SESSION["profile_success"])){
        $profileSuccess = $_SESSION["profile_success"];
        unset($_SESSION["profile_success"]);
    }

    $adminId = (int)($_SESSION["user_id"] ?? 0);

    if($page === "profile"){
        $adminData = $userModel->getById($adminId);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = trim($_POST["name"] ?? "");
            $surname = trim($_POST["surname"] ?? "");
            $email = trim($_POST["email"] ?? "");
            $usernameInput = trim($_POST["username"] ?? "");

            $newPass = $_POST["new_password"] ?? "";
            $confirmPass = $_POST["confirm_password"] ?? "";

            if ($name === "" || $surname === "" || $email === "" || $usernameInput === "") {
                $profileError = "Please fill all fields (except password).";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $profileError = "Email is not valid.";
            } elseif ($userModel->existsEmailOrUsernameExcept($email, $usernameInput, $adminId)) {
                $profileError = "Email or username already exists.";
            } elseif ($newPass !== "") {
                if (strlen($newPass) < 8) {
                    $profileError = "New password must be at least 8 characters.";
                } elseif ($newPass !== $confirmPass) {
                    $profileError = "Passwords do not match.";
                }
            }
            if ($profileError === null) {
            $passToSave = ($newPass !== "") ? $newPass : null;

            if ($userModel->updateProfile($adminId, $name, $surname, $email, $usernameInput, $passToSave)) {
                $_SESSION["username"] = $usernameInput;

                $_SESSION["profile_success"] = "Profile updated successfully!";
                header("Location: dashboard.php?page=profile");
                exit;
            } else {
                $profileError = "Failed to update profile.";
            }
        }
        $adminData = [
            "name" => $name,
            "surname" => $surname,
            "email" => $email,
            "username" => $usernameInput
        ];
        }
    }
    $messages = [];
    if ($page === "messages") {
        $stmt = $conn->prepare("SELECT id, first_name, last_name, email, message, created_at
                            FROM contact_messages
                            ORDER BY id DESC");
        $stmt->execute();
        $messages = $stmt->fetchAll();
    }
    $messagesCount = 0;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM contact_messages");
    $stmt->execute();
    $messagesCount = (int)$stmt->fetchColumn();
    $productsCount = 0;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM products");
    $stmt->execute();
    $productsCount = (int)$stmt->fetchColumn();


    require_once __DIR__ . "/../repositories/ProductRepository.php";
    require_once __DIR__ . "/../models/Product.php";

    $productRepo = new ProductRepository($conn);
    $products = [];

    if ($page === "products") {
      $products = $productRepo->getAll();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../img/logo3.png">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="dashboard.css">
</head>
<body class="admin-body">

<div class="layout">

  <aside class="sidebar">
    <h2>Admin</h2>
    <p class="welcome">Welcome, <?= htmlspecialchars($adminName) ?></p>

    <nav>
      <a class="<?= $page==='dashboard'?'active':'' ?>" href="?page=dashboard">Dashboard</a>
      <a class="<?= $page==='users'?'active':'' ?>" href="?page=users">Users</a>
      <a class="<?= $page==='profile'?'active':'' ?>" href="?page=profile">Edit Profile</a>
      <a class="<?= $page==='products'?'active':'' ?>" href="?page=products">Products</a>
      <a class="<?= $page==='messages'?'active':'' ?>" href="?page=messages">Messages</a>
      <a href="../logout.php">Logout</a>
    </nav>
  </aside>
  <main class="content">
    <header class="topbar"><span>Dashboard</span>
        <a class="btn-back" href="../index.php">Go Back</a>
    </header>

    <?php if ($page === "dashboard"): ?>
        <h3>Overview</h3>
        <div style="display:flex;gap:12px;">
            <div class="card">Total users: <b><?= count($users) ?></b></div>
            <div class="card">Total messages: <b><?= $messagesCount ?></b></div>
            <div class="card">Total products: <b><?= $productsCount ?></b></div>
        </div>

    <?php elseif ($page === "users"): ?>
      <h3>Users</h3>
      <table>
        <tr>
          <th>ID</th><th>Username</th><th>Name</th><th>Surname</th><th>Email</th><th>Role</th>
        </tr>
        <?php foreach ($users as $u): ?>
        <tr>
          <td><?= $u["id"] ?></td>
          <td><?= htmlspecialchars($u["username"]) ?></td>
          <td><?= htmlspecialchars($u["name"]) ?></td>
          <td><?= htmlspecialchars($u["surname"]) ?></td>
          <td><?= htmlspecialchars($u["email"]) ?></td>
          <td><?= htmlspecialchars($u["role"]) ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php elseif ($page === "profile"): ?>
        <h3 style="text-align:center;">Edit Profile</h3>

    <div class="panel">

  <?php if (!empty($profileSuccess)): ?>
    <div class="msg success"><?= htmlspecialchars($profileSuccess) ?></div>
  <?php endif; ?>

  <?php if (!empty($profileError)): ?>
    <div class="msg error"><?= htmlspecialchars($profileError) ?></div>
  <?php endif; ?>

  <form class="form" method="POST" action="?page=profile">
    <div>
      <label>Name</label>
      <input class="input" type="text" name="name" value="<?= htmlspecialchars($adminData["name"] ?? "") ?>">
    </div>

    <div>
      <label>Surname</label>
      <input class="input" type="text" name="surname" value="<?= htmlspecialchars($adminData["surname"] ?? "") ?>">
    </div>

    <div>
      <label>Email</label>
      <input class="input" type="email" name="email" value="<?= htmlspecialchars($adminData["email"] ?? "") ?>">
    </div>

    <div>
      <label>Username</label>
      <input class="input" type="text" name="username" value="<?= htmlspecialchars($adminData["username"] ?? "") ?>">
    </div>

    <div class="full"><hr></div>
    <div class="full" style="font-weight:800;color:#7a1f45;">Change Password (optional)</div>

    <div>
      <label>New Password</label>
      <input class="input" type="password" name="new_password" placeholder="Leave empty to keep current">
    </div>

    <div>
      <label>Confirm Password</label>
      <input class="input" type="password" name="confirm_password">
    </div>

    <button class="btn-primary" type="submit">Save Changes</button>
  </form>
</div>
    <?php elseif ($page === "messages"): ?>
  <h3>Contact Messages</h3>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Date</th>
    </tr>
    <?php foreach ($messages as $m): ?>
    <tr>
      <td><?= htmlspecialchars($m["first_name"]." ".$m["last_name"]) ?></td>
      <td><?= htmlspecialchars($m["email"]) ?></td>
      <td><?= htmlspecialchars($m["message"]) ?></td>
      <td><?= htmlspecialchars($m["created_at"]) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
    <?php elseif ($page === "products"): ?>
  <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
    <h3 style="margin:0;">Products</h3>
    <a class="btn-back" href="products/add.php">+ Add Product</a>
  </div>

  <table>
    <tr>
      <th>Name</th><th>Description</th><th>Price</th><th>Qty</th><th>Actions</th>
    </tr>
    <?php foreach ($products as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p["name"]) ?></td>
        <td><?= htmlspecialchars($p["description"]) ?></td>
        <td>€<?= htmlspecialchars($p["price"]) ?></td>
        <td><?= (int)$p["quantity"] ?></td>
        <td class="actions">
          <a id="product-edit-<?= (int)$p["id"] ?>" class="btn-edit action-edit"
            href="products/edit.php?id=<?= (int)$p["id"] ?>">Edit</a>

          <form method="POST" action="products/delete.php" style="display:inline;">
          <input type="hidden" name="id" value="<?= (int)$p["id"] ?>">
          <button id="product-delete-<?= (int)$p["id"] ?>" class="btn-delete action-delete"
            type="submit" onclick="return confirm('Delete this product?')">
           Delete
          </button>
        </form>


          </form>
        </td>

      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>


  </main>
</div>

</body>
</html>