<?php
session_start();
require_once "config/db.php";
include "includes/header.php";
?>

<h2>Your Cart</h2>

<?php
if (empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
} else {
    foreach ($_SESSION['cart'] as $id => $qty) {

        $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $id");
        $product = mysqli_fetch_assoc($result);

        echo "<div>";
        echo "<strong>" . $product['name'] . "</strong><br>";
        echo "Price: $" . number_format($product['price'], 2) . "<br>";
        echo "Quantity: " . $qty . "<br>";
?>

        <form method="post" action="updatecart.php" style="margin-top: 5px;">
            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
            <label>Qty:</label>
            <input type="number" name="quantity" value="<?php echo $qty; ?>" min="1">
            <button type="submit">Update</button>
        </form>

        <form method="post" action="removecart.php" style="margin-top: 5px;">
            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
            <button type="submit">Remove</button>
        </form>

<?php
        echo "</div><hr>";
    }
}
?>

<a href="index.php">Continue Shopping</a>

<?php include "includes/footer.php"; ?>