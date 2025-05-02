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
    $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $oldQuantity = $_POST['old_quantity'];
    $type = 'addmore';
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $newupQuantity = (int)$quantity + (int)$oldQuantity;


    $result = updateProduct($id, $name, $newupQuantity, $category, $brand, $price);
    $report = report_product($name, $quantity, $category, $brand, $price, $userId, $description, $type);
    if ($result) {
        $_SESSION['success'] = "Product updated successfully.";
        header('Location: /products');
    } else {
        $_SESSION['error'] = "Failed to update product.";
        header('Location: /products');
    }
}