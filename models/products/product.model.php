<?php
require_once __DIR__ . '/../../config/db.php';

function addCategory($categoryName): bool
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('s', $categoryName);
    $result = $statement->execute();

    $statement->close();
    return $result;
}

function getAllCategories(): array
{
    global $mysqli; // Use the mysqli connection
    $query = "SELECT * FROM categories";
    $result = $mysqli->query($query);

    if ($result === false) {
        die("Query failed: " . $mysqli->error);
    }

    $categories = $result->fetch_all(MYSQLI_ASSOC);
    $result->free(); // Free the result set
    return $categories;
}

function deleteCategory($categoryId): bool
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("DELETE FROM categories WHERE id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $categoryId);
    $result = $statement->execute();

    $statement->close();
    return $result;
}

function updateCategory($categoryId, $newCategoryName): bool
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("UPDATE categories SET name = ? WHERE id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('si', $newCategoryName, $categoryId);
    $result = $statement->execute();

    $statement->close();
    return $result;
}

function addProduct($name, $quantity, $category, $brand, $price, $userId): bool
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("INSERT INTO products (name, quantity, category, brand, price, user_id) VALUES (?, ?, ?, ?, ?, ?)");

    if ($statement === false) {
        die("Prepare failed: " . htmlspecialchars($mysqli->error));
    }

    $statement->bind_param('sissdi', $name, $quantity, $category, $brand, $price, $userId);
    $result = $statement->execute();

    if ($result === false) {
        die("Execute failed: " . htmlspecialchars($statement->error));
    }

    $statement->close();
    return $result;
}

function report_product($name, $quantity, $category, $brand, $price, $userId,$description,$type): bool
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("INSERT INTO report_product (name, quantity, category, brand, price, user_id,des,report_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($statement === false) {
        die("Prepare failed: " . htmlspecialchars($mysqli->error));
    }

    $statement->bind_param('sissdiss', $name, $quantity, $category, $brand, $price, $userId, $description, $type);
    $result = $statement->execute();

    if ($result === false) {
        die("Execute failed: " . htmlspecialchars($statement->error));
    }

    $statement->close();
    return $result;
}

function getAllreportsaddmore($userId): array
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT * FROM report_product WHERE user_id = ? AND report_type = 'addmore' ORDER BY id DESC");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $reports = $result->fetch_all(MYSQLI_ASSOC);
    $result->free(); // Free the result set
    $statement->close();
    return $reports;
}
function getAllreportsAdjust($userId): array
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT * FROM report_product WHERE user_id = ? AND report_type = 'adjust' ORDER BY id DESC");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $reports = $result->fetch_all(MYSQLI_ASSOC);
    $result->free(); // Free the result set
    $statement->close();
    return $reports;
}

function getAllProducts($userId): array
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT * FROM products WHERE user_id = ? ORDER BY id DESC");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $products = $result->fetch_all(MYSQLI_ASSOC);
    $result->free(); // Free the result set
    $statement->close();
    return $products;
}

function deleteProduct($productId): bool
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("DELETE FROM products WHERE id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $productId);
    $result = $statement->execute();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $statement->close();
    return $result;
}

function updateProduct($productId, $newProductName, $newupQuantity, $newCategory, $newBrand, $newPrice): bool
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("UPDATE products SET name = ?, quantity = ?, category = ?, brand = ?, price = ? WHERE id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('sissdi', $newProductName, $newupQuantity, $newCategory, $newBrand, $newPrice, $productId);
    $result = $statement->execute();

    if ($result === false) {
        die("Execute failed: " . htmlspecialchars($statement->error));
    }

    $statement->close();
    return $result;
}
function exportProducts($userId, $products, $description): array
{
    global $mysqli; // Use the mysqli connection

    // Convert products array to JSON
    $productsJson = json_encode($products);

    // Prepare the SQL statement
    $stmt = $mysqli->prepare("INSERT INTO product_exports (products, description,user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $productsJson, $description, $userId);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        $exportId = $stmt->insert_id; // Get the last insert ID
        $stmt->close();

        return [
            "success" => true,
            "export_id" => $exportId,
            "message" => "Product export inserted successfully."
        ];
    } else {
        // Handle error
        $error = $stmt->error;
        $stmt->close();

        return [
            "success" => false,
            "message" => "Error inserting product export: " . $error
        ];
    }
}

function editQuantity($productId, $newQuantity): bool
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("UPDATE products SET quantity = ? WHERE id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('ii', $newQuantity, $productId);
    $result = $statement->execute();

    if ($result === false) {
        die("Execute failed: " . htmlspecialchars($statement->error));
    }

    $statement->close();
    return $result;
}
function getProductQuantityById($productId): int
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT quantity FROM products WHERE id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $productId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $product = $result->fetch_assoc();
    $result->free(); // Free the result set
    $statement->close();
    return $product['quantity'] ?? 0;
}

function getBrands(): array
{
    global $mysqli; // Use the mysqli connection
    $query = "SELECT DISTINCT brand FROM products order by brand desc";
    $result = $mysqli->query($query);

    if ($result === false) {
        die("Query failed: " . $mysqli->error);
    }

    $brands = $result->fetch_all(MYSQLI_ASSOC);
    $result->free(); // Free the result set
    return $brands;
}

function getAllExports(): array
{
    global $mysqli; // Use the mysqli connection
    $query = "SELECT * FROM product_exports order by export_id desc";
    $result = $mysqli->query($query);

    if ($result === false) {
        die("Query failed: " . $mysqli->error);
    }

    $exports = $result->fetch_all(MYSQLI_ASSOC);
    $result->free(); // Free the result set
    return $exports;
}

function countCategories(): int
{
    global $mysqli; // Use the mysqli connection
    $query = "SELECT COUNT(*) as count FROM categories";
    $result = $mysqli->query($query);

    if ($result === false) {
        die("Query failed: " . $mysqli->error);
    }

    $count = $result->fetch_assoc()['count'];
    $result->free(); // Free the result set
    return $count;
}

function countProducts($userId): int
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT COUNT(*) as count FROM products WHERE user_id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $count = $result->fetch_assoc()['count'];
    $result->free(); // Free the result set
    $statement->close();
    return $count;
}


function sumPrice($userId): float
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT SUM(price) as total FROM report_product WHERE user_id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $total = $result->fetch_assoc()['total'] ?? 0;
    $result->free(); // Free the result set
    $statement->close();
    return (float)$total;
}

function getPriceByDate($userId): array
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT price, created_at as date FROM report_product WHERE user_id = ? ");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $prices = $result->fetch_all(MYSQLI_ASSOC);
    $result->free(); // Free the result set
    $statement->close();
    return $prices;
}

function getProductDate($userId): array
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT quantity, created_at as date FROM report_product WHERE user_id = ? ");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $prices = $result->fetch_all(MYSQLI_ASSOC);
    $result->free(); // Free the result set
    $statement->close();
    return $prices;
}

function getLessQuantity($userId): array
{
    global $mysqli;
    $statement = $mysqli->prepare('SELECT * FROM products WHERE quantity <= 10 AND user_id = ? ORDER BY id DESC');

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $lessQuantity = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    $statement->close();
    return $lessQuantity;
}

function countLessQuantity($userId): int
{
    global $mysqli; // Use the mysqli connection
    $statement = $mysqli->prepare("SELECT COUNT(*) as total FROM products WHERE quantity <= 10 AND user_id = ?");

    if ($statement === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $statement->bind_param('i', $userId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result === false) {
        die("Execute failed: " . $statement->error);
    }

    $total = $result->fetch_assoc()['total'];
    $result->free(); // Free the result set
    $statement->close();
    return (int)$total;
}