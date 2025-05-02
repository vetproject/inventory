<?php
session_start();
require_once __DIR__ . '/../../models/products/product.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Retrieve the product ID from the POST request
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $oldQuantity = $_POST['old_quantity'];
    $userId = $_POST['user_id'];
    $description = $_POST['description'];
    $type = 'adjust';

    $newupQuantity = (int)$oldQuantity - (int)$quantity  ;


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
