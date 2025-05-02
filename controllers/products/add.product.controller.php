<?php
session_start();
require_once __DIR__ . '/../../models/products/product.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['productName'];
    $quantity = $_POST['productQuantity'];
    $category = $_POST['productCategory'];
    $brand = $_POST['productBrand'];
    $price = $_POST['productPrice'];
    $userId = $_POST['user_id'];
    $description = 'null';
    $type = 'addmore';

    // echo "$name, $quantity, $category, $brand, $price ,$userId" ;

    $result = addProduct($name, $quantity, $category, $brand, $price, $userId);
    $report = report_product($name, $quantity, $category, $brand, $price, $userId, $description, $type);
    
    if ($result) {
        header('Location: /products');
    } else {
        // Provide detailed error feedback
        $error = mysqli_error($mysqli); // Get the last error from the mysqli connection
        echo 'Failed to add product: ' . htmlspecialchars($error);
    }
}