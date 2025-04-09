<?php
session_start();
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];

    // echo $id . ' ' . $name . ' ' . $quantity . ' ' . $category . ' ' . $brand . ' ' . $price;
    $result = updateProduct($id, $name, $quantity, $category, $brand, $price);
    if ($result) {
        $_SESSION['success'] = "Product updated successfully.";
        header('Location: /products');
    } else {
        $_SESSION['error'] = "Failed to update product.";
        header('Location: /products');
    }
}