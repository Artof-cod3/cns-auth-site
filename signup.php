<?php
require 'db.php';
$msg = "";
$msg_class = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username  = trim($_POST["username"]);
    $email     = trim($_POST["email"]);
    $full_name = trim($_POST["full_name"]);
    $password  = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, full_name, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $full_name, $password);
    if ($stmt->execute()) {
        $msg = "Registration successful! You can now log in.";
        $msg_class = "alert-success";
    } else {
        $msg = "Error: username may already exist.";
        $msg_class = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width:450px;">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="text-center mb-4">CNS Student Portal - Sign Up</h3>
        <?php if ($msg): ?>
          <div class="alert <?= $msg_class ?>"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <form method="POST" action="signup.php">
          <div class="mb-3"><input class="form-control" name="username" placeholder="Username" required></div>
          <div class="mb-3"><input class="form-control" name="full_name" placeholder="Full name" required></div>
          <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
          <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
          <button class="btn btn-primary w-100" type="submit">Register</button>
        </form>
        <p class="text-center mt-3">Already registered? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
</body>
</html>
