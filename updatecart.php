<?php
session_start();

if (isset($_POST['product_id'], $_POST['quantity'])) {
    $id = $_POST['product_id'];
    $qty = (int)$_POST['quantity'];

    if ($qty < 1) {
        $qty = 1; // prevent negative/zero quantities
    }

    $_SESSION['cart'][$id] = $qty;
}

header("Location: viewcart.php");
exit();
?>