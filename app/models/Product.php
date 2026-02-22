<?php

class Product {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $query = "SELECT product_id AS id, name, description, price, image_url FROM products";
        $result = mysqli_query($this->conn, $query);

        return $result;
    }

    public function getProductById($id) {
        $id = (int)$id;
        $query = "SELECT * FROM products WHERE product_id = $id";
        $result = mysqli_query($this->conn, $query);

        return mysqli_fetch_assoc($result);
    }
}