<?php
// cart.view.php
// Expects from CartController->view():
// $cartItems, $subtotal, $tax, $shipping, $grandTotal

// Safety defaults (in case something is missing)
$cartItems   = $cartItems   ?? [];
$subtotal    = $subtotal    ?? 0;
$tax         = $tax         ?? 0;
$shipping    = $shipping    ?? 0;
$grandTotal  = $grandTotal  ?? 0;

include __DIR__ . "/../../includes/header.php";
?>

<h2>Your Cart</h2>

<?php if (empty($cartItems)) : ?>
    <p>Your cart is empty.</p>
    <p><a href="index.php?controller=catalog&action=index">Continue Shopping</a></p>

<?php else : ?>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($cartItems as $item) : ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td>$<?php echo number_format((float)$item['price'], 2); ?></td>

                <td>
                    <!-- Update quantity (type a number, click Update) -->
                    <form method="post" action="index.php?controller=cart&action=update" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo (int)$item['id']; ?>">
                        <input
                            type="number"
                            name="quantity"
                            value="<?php echo (int)$item['qty']; ?>"
                            min="0"
                            style="width:70px;"
                        >
                        <button type="submit">Update</button>
                    </form>
                </td>

                <td>$<?php echo number_format((float)$item['line_total'], 2); ?></td>

                <td>
                    <!-- Remove entire item (removes all quantity) -->
                    <form method="post" action="index.php?controller=cart&action=remove" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo (int)$item['id']; ?>">
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

            <!-- Totals section -->
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Subtotal</strong></td>
                <td colspan="2"><strong>$<?php echo number_format((float)$subtotal, 2); ?></strong></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Tax (5%)</strong></td>
                <td colspan="2"><strong>$<?php echo number_format((float)$tax, 2); ?></strong></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Shipping/Handling (10%)</strong></td>
                <td colspan="2"><strong>$<?php echo number_format((float)$shipping, 2); ?></strong></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Grand Total</strong></td>
                <td colspan="2"><strong>$<?php echo number_format((float)$grandTotal, 2); ?></strong></td>
            </tr>

        </tbody>
    </table>

    <br>

    <!-- Clear entire cart -->
    <form method="post" action="index.php?controller=cart&action=clear" style="display:inline;">
        <button type="submit">Clear Cart</button>
    </form>

    <!-- Optional: Checkout action (clears cart + returns to catalog) -->
    <form method="post" action="index.php?controller=cart&action=checkout" style="display:inline; margin-left:10px;">
        <button type="submit">Checkout</button>
    </form>

    <p style="margin-top:15px;">
        <a href="index.php?controller=catalog&action=index">Continue Shopping</a>
    </p>

<?php endif; ?>

<?php include __DIR__ . "/../../includes/footer.php"; ?>