<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
    <a href="index.php">Logout</a>
</body>
</html>
