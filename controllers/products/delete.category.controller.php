<?php
session_start();
require_once __DIR__ . '/../../models/products/product.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['categoryId'];

    $result = deleteCategory($id);
    if ($result) {
        header('Location: /products');
    } else {
        echo 'Failed to delete category.';
    }
}