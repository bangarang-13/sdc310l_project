<?php
// Start session FIRST for flash messages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// One-time checkout popup (MVC flash)
if (!empty($_SESSION['checkout_message'])) {
    $msg = addslashes($_SESSION['checkout_message']);
    unset($_SESSION['checkout_message']); // show once only
    echo "<script>alert('{$msg}');</script>";
}

include __DIR__ . "/../../includes/header.php";
?>

<h2>Product Catalog</h2>
<hr>

<?php
if (!$products) {
    echo "<p>Error retrieving products.</p>";
} else {
    while ($row = mysqli_fetch_assoc($products)) {
?>
        <div class="product">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
            <p><strong>$<?php echo number_format($row['price'], 2); ?></strong></p>

            <form method="post" action="index.php?controller=cart&action=add">
                <input type="hidden" name="product_id" value="<?php echo (int)$row['id']; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <hr>
<?php
    }
}
?>

<?php include __DIR__ . "/../../includes/footer.php"; ?>