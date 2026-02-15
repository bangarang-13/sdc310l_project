<?php
require_once "config/db.php";
include "includes/header.php";
?>

<h2>Product Catalog</h2>

<?php
$result = mysqli_query($conn, "SELECT * FROM products");

if (!$result) {
    echo "<p>Error retrieving products.</p>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="product">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['description']; ?></p>
            <p><strong>$<?php echo number_format($row['price'], 2); ?></strong></p>

            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <hr>
<?php
    }
}
?>

<?php
include "includes/footer.php";
?>