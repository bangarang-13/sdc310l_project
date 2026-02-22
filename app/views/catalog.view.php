<?php include __DIR__ . "/../../includes/header.php"; ?>

<h2>Product Catalog</h2>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
	$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    $cartCount = array_sum($_SESSION['cart']);
}
?>

<p><strong>Items in cart:</strong> <?php echo $cartCount; ?></p>
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