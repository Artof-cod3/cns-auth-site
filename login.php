<?php
session_start();
require 'db.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hash);
    if ($stmt->fetch() && password_verify($_POST["password"], $hash)) {
        $_SESSION["user"] = $username;
        header("Location: welcome.php");
        exit;
    }
    $msg = "Invalid username or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width:450px;">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="text-center mb-4">CNS Student Portal - Login</h3>
        <?php if ($msg): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
          <div class="mb-3"><input class="form-control" name="username" placeholder="Username" required></div>
          <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
          <button class="btn btn-success w-100" type="submit">Login</button>
        </form>
        <p class="text-center mt-3">No account? <a href="signup.php">Sign up</a></p>
      </div>
    </div>
  </div>
</body>
</html>
