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

    $newQuantity =  $quantity - $oldQuantity;

    // echo $id . ' ' . $name . ' ' . $quantity . ' ' . $category . ' ' . $brand . ' ' . $price . ' ' . $userId;
    $result = updateProduct($id, $name, $quantity, $category, $brand, $price);
    $report = report_product($name, $newQuantity , $category, $brand, $price, $userId);
    if ($result) {
        $_SESSION['success'] = "Product updated successfully.";
        header('Location: /products');
    } else {
        $_SESSION['error'] = "Failed to update product.";
        header('Location: /products');
    }
}