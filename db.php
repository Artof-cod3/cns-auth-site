<?php
$host   = "localhost";
$dbname = "CAT2";
$user   = "cat_user";
$pass   = "StrongPass123!";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
