<?php include __DIR__ . "/../../includes/header.php"; ?>

<h2>Your Cart</h2>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<p>Your cart is empty.</p>";
    echo '<p><a href="index.php">Continue Shopping</a></p>';
    include __DIR__ . "/../../includes/footer.php";
    exit();
}
?>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Actions</th>
    </tr>

    <?php
    $grandTotal = 0;

    foreach ($cart as $productId => $qty) {
        $productId = (int)$productId;
        $qty = (int)$qty;

        // Pull product from DB
        $product = $productModel->getProductById($productId);

        // If product no longer exists, skip it
        if (!$product) {
            continue;
        }

        $name  = $product['name'];
        $price = (float)$product['price'];
        $lineTotal = $price * $qty;
        $grandTotal += $lineTotal;
        ?>

        <tr>
            <td><?php echo htmlspecialchars($name); ?></td>
            <td>$<?php echo number_format($price, 2); ?></td>

            <td>
                <form method="post" action="index.php?controller=cart&action=update" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $productId; ?>">
                    <input
                        type="number"
                        name="qty"
                        value="<?php echo $qty; ?>"
                        min="0"
                        style="width:70px;"
                    >
                    <button type="submit">Update</button>
                </form>
            </td>

            <td>$<?php echo number_format($lineTotal, 2); ?></td>

            <td>
                <a href="index.php?controller=cart&action=remove&id=<?php echo $productId; ?>"
                   onclick="return confirm('Remove this item from the cart?');">
                    Remove
                </a>
            </td>
        </tr>

    <?php } ?>

    <tr>
        <td colspan="3" style="text-align:right;"><strong>Grand Total</strong></td>
        <td colspan="2"><strong>$<?php echo number_format($grandTotal, 2); ?></strong></td>
    </tr>
</table>

<br>

<form method="post" action="index.php?controller=cart&action=clear" style="display:inline;">
    <button type="submit" onclick="return confirm('Clear the entire cart?');">Clear Cart</button>
</form>

<p><a href="index.php">Continue Shopping</a></p>

<?php include __DIR__ . "/../../includes/footer.php"; ?>