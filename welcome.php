<?php
session_start();
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5 text-center">
    <div class="alert alert-success">
      <h3>Login successful!</h3>
      <p>Welcome, <strong><?= htmlspecialchars($_SESSION["user"]) ?></strong></p>
    </div>
    <a href="logout.php" class="btn btn-outline-secondary">Logout</a>
  </div>
</body>
</html>
