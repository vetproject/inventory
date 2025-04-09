<?php
session_start();
require_once __DIR__ . '/../../models/products/product.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    
    $result = deleteProduct($productId);
    if ($result) {
        header('Location: /products');
    } else {
        echo 'Failed to delete product.';
    }
}