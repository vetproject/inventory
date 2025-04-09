<?php
session_start();
require_once __DIR__ . '/../../models/products/product.model.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the exported products data
    $desc = $_POST['description'] ?? '';
    $userId = $_POST['userId'] ?? 0; // Assuming user ID is passed in the POST request
    $exportedProductsJson = $_POST['exportedProducts'] ?? '';
    $exportedProducts = json_decode($exportedProductsJson, true);


    // echo "$desc\n , $userId\n , $exportedProductsJson\n";

    foreach ($exportedProducts as $product) {
        $productId = $product['id'] ?? 0;
        $quantityToSubtract = $product['count'] ?? 0;
    
        // Get the current quantity
        $currentQuantity = getProductQuantityById($productId);
    
        // Calculate the new quantity
        $newQuantity = $currentQuantity - $quantityToSubtract;
    
        // Update the product quantity if the new quantity is valid
        if ($newQuantity >= 0) { // Ensure quantity doesn't go negative
            $success = editQuantity($productId, $newQuantity);
            if ($success) {
                echo "Updated product ID $productId to new quantity $newQuantity\n";
            } else {
                echo "Failed to update product ID $productId\n";
            }
        } else {
            echo "Cannot update product ID $productId: new quantity would be negative.\n";
        }
    }
    
    $result = exportProducts($userId, $exportedProducts, $desc);
    if ($result['success']) {
        $_SESSION['success'] = "Product export inserted successfully!";
        header("Location: /products");
    } else {
        $_SESSION['error'] = "Failed to insert product export: " . $result['message'];
        header("Location: /products");
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: /products");
    exit;
}
?>