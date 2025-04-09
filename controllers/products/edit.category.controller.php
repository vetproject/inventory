<?php
session_start();
require_once __DIR__ . '/../../models/products/product.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['categoryId'];
    $name = $_POST['categoryName'];

    $result = updateCategory($id, $name);
    if ($result) {
        header('Location: /products');
    } else {
        echo 'Failed to update category.';
    }
}