<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    $cartCount = array_sum($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDC310L Southwell's Store</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>

<header class="site-header">
    <h1 class="site-title">SDC310L Southwell's Store</h1>

    <nav class="site-nav">
        <a href="index.php">Catalog</a>
        <a href="index.php?controller=cart&action=view">View Cart (<?php echo $cartCount; ?>)</a>
    </nav>
</header>

<main class="site-main">