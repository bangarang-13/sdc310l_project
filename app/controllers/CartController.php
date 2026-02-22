<?php

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/Product.php";

class CartController
{
    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

        if ($productId > 0) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (!isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] = 0;
            }

            $_SESSION['cart'][$productId] += 1;
        }

        header("Location: index.php");
        exit();
    }

    public function view()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        global $conn;
        $productModel = new Product($conn);

        include __DIR__ . "/../views/cart.view.php";
    }

    // Update quantity via textbox
    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $productId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $qty       = isset($_POST['qty']) ? (int)$_POST['qty'] : 0;

        if ($productId > 0) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // qty must be 0 or more
            if ($qty <= 0) {
                unset($_SESSION['cart'][$productId]); // remove item entirely
            } else {
                $_SESSION['cart'][$productId] = $qty;
            }
        }

        header("Location: index.php?controller=cart&action=view");
        exit();
    }

    public function remove()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($productId > 0 && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        header("Location: index.php?controller=cart&action=view");
        exit();
    }

    public function clear()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['cart'] = [];

        header("Location: index.php?controller=cart&action=view");
        exit();
    }
}