<?php
session_start();
require 'db.php';
$msg = "";
$msg_class = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST["name"]);
    $email   = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    if ($stmt->execute()) {
        $msg = "Feedback saved successfully!";
        $msg_class = "alert-success";
    } else {
        $msg = "Error saving feedback.";
        $msg_class = "alert-danger";
    }
}

$result = $conn->query("SELECT id, name, email, message, submitted_at FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Feedback</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width:800px;">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3 class="text-center mb-4">CNS Student Portal - Feedback</h3>
        <?php if ($msg): ?>
          <div class="alert <?= $msg_class ?>"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <form method="POST" action="feedback.php">
          <div class="mb-3"><input class="form-control" name="name" placeholder="Your name" required></div>
          <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
          <div class="mb-3"><textarea class="form-control" name="message" rows="3" placeholder="Your feedback" required></textarea></div>
          <button class="btn btn-primary w-100" type="submit">Submit Feedback</button>
        </form>
      </div>
    </div>

    <div class="card shadow">
      <div class="card-body">
        <h4 class="mb-3">Submitted Feedback</h4>
        <table class="table table-striped">
          <thead>
            <tr><th>#</th><th>Name</th><th>Email</th><th>Message</th><th>Time</th></tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row["id"] ?></td>
              <td><?= htmlspecialchars($row["name"]) ?></td>
              <td><?= htmlspecialchars($row["email"]) ?></td>
              <td><?= htmlspecialchars($row["message"]) ?></td>
              <td><?= $row["submitted_at"] ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    <p class="text-center mt-3"><a href="login.php">Back to Login</a></p>
  </div>
</body>
</html>
