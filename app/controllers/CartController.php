<?php

class CartController
{
    // Rates for Week 5 requirements
    private float $taxRate = 0.05;       // 5%
    private float $shippingRate = 0.10;  // 10%

    private function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Add an item to the cart (increments quantity)
    public function add(): void
    {
        $this->ensureSession();

        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        if ($productId <= 0) {
            header("Location: index.php");
            exit();
        }

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 0;
        }

        $_SESSION['cart'][$productId]++;

        // Return user to catalog
        header("Location: index.php");
        exit();
    }

    // Update quantity for a specific product (type a number and press Update)
    public function update(): void
    {
        $this->ensureSession();

        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        $quantity  = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

        if ($productId <= 0) {
            header("Location: index.php?controller=cart&action=view");
            exit();
        }

        // If quantity is 0 or less, remove item
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }

        header("Location: index.php?controller=cart&action=view");
        exit();
    }

    // Remove an item entirely (removes all quantity)
    public function remove(): void
    {
        $this->ensureSession();

        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        if ($productId > 0) {
            unset($_SESSION['cart'][$productId]);
        }

        header("Location: index.php?controller=cart&action=view");
        exit();
    }

    // Clear the whole cart
    public function clear(): void
    {
        $this->ensureSession();
        $_SESSION['cart'] = [];

        header("Location: index.php?controller=cart&action=view");
        exit();
    }

    // Cart page (MVC) + totals (subtotal, tax, shipping, grand total)
    public function view(): void
    {
        $this->ensureSession();

        // IMPORTANT: your project uses a global $conn (from config/db.php)
        global $conn;

        // Load model
        $productModel = new Product($conn);

        $cartItems = [];
        $subtotal = 0.00;

        // Build cart item list from session
        foreach ($_SESSION['cart'] as $productId => $qty) {
            $productId = (int)$productId;
            $qty = (int)$qty;

            if ($productId <= 0 || $qty <= 0) {
                continue;
            }

            $product = $productModel->getProductById($productId);
            if (!$product) {
                continue; // product missing in DB, skip it
            }

            $price = (float)$product['price'];
            $lineTotal = $price * $qty;

            $cartItems[] = [
                'id' => $productId,
                'name' => $product['name'],
                'price' => $price,
                'qty' => $qty,
                'line_total' => $lineTotal
            ];

            $subtotal += $lineTotal;
        }

        // Calculate totals (Week 5 requirement)
        $tax = round($subtotal * $this->taxRate, 2);
        $shipping = round($subtotal * $this->shippingRate, 2);
        $grandTotal = round($subtotal + $tax + $shipping, 2);

        // Make variables available to the view
        // (cart.view.php will use these)
        include __DIR__ . "/../views/cart.view.php";
    }

    // Simple checkout action (Week 5 requirement)
    // This can be improved later, but meets "checkout actions including clearing cart"
    public function checkout(): void
    {
        $this->ensureSession();

        // For now: clear cart and show a simple confirmation message
        $_SESSION['cart'] = [];
        $_SESSION['checkout_message'] = "Checkout complete. Thank you for your order!";

        header("Location: index.php?controller=catalog&action=index");
        exit();
    }
}