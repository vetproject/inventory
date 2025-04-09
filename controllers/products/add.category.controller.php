<?php
session_start();
require_once __DIR__ . '/../../models/products/product.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['categoryName'];

    $result = addCategory($name);
    if ($result) {
        $_SESSION['success'] = "Category added successfully!";
        header("Location: /products");
    } else {
        $_SESSION['error'] = "Failed to add category.";
    }
}