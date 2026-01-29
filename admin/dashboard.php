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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="layout">

  <aside class="sidebar">
    <h2>Admin</h2>
    <p class="welcome">Welcome, <?= htmlspecialchars($adminName) ?></p>

    <nav>
      <a class="<?= $page==='dashboard'?'active':'' ?>" href="?page=dashboard">Dashboard</a>
      <a class="<?= $page==='users'?'active':'' ?>" href="?page=users">Users</a>
      <a class="<?= $page==='profile'?'active':'' ?>" href="?page=profile">Edit Profile</a>
      <a class="<?= $page==='products'?'active':'' ?>" href="?page=products">Products</a>
      <a href="../logout.php">Logout</a>
    </nav>
  </aside>
  <main class="content">
    <header class="topbar"><span>Dashboard</span>
        <a class="btn-back" href="../index.php">Go Back</a>
    </header>

    <?php if ($page === "dashboard"): ?>
      <h3>Overview</h3>
      <div class="card">Total users: <b><?= count($users) ?></b></div>

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

    <?php else: ?>
      <p>Coming soon...</p>
    <?php endif; ?>

  </main>
</div>

</body>
</html>