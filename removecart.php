<?php
session_start();

if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];
    unset($_SESSION['cart'][$id]);
}

header("Location: viewcart.php");
exit();
?>