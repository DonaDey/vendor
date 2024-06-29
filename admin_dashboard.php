<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'vendor'");
$stmt->execute();
$vendors = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM orders");
$stmt->execute();
$orders = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM payments");
$stmt->execute();
$payments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>

    <h3>Vendors</h3>
    <ul>
        <?php foreach ($vendors as $vendor): ?>
            <li><?php echo $vendor['username']; ?> - <?php echo $vendor['email']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Products</h3>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?php echo $product['name']; ?> - $<?php echo $product['price']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Orders</h3>
    <ul>
        <?php foreach ($orders as $order): ?>
            <li>Order ID: <?php echo $order['id']; ?> - Status: <?php echo $order['status']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Payments</h3>
    <ul>
        <?php foreach ($payments as $payment): ?>
            <li>Payment ID: <?php echo $payment['id']; ?> - Amount: $<?php echo $payment['amount']; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>
