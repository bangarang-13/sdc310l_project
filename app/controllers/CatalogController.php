<?php

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/Product.php";

class CatalogController {

    public function index() {
        // Create model instance
        global $conn;
		$productModel = new Product($conn);


        // Get products from DB
        $products = $productModel->getAllProducts();

        // Load the view
        include __DIR__ . "/../views/catalog.view.php";
    }
}