<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';

$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

$exports = getAllreports($userId);

// Define $categories if not already defined
$categories = getAllCategories(); // Replace with your actual function to fetch categories
?>
<?php
require_once 'layouts/header.php';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="container-fluid">
    <div class="row">
        <aside class="d-none d-md-block bg-light sidebar bg-warning" style="width:25%;">
            <?php
            require_once 'layouts/navbar.php';
            ?>
        </aside>

        <div class="bg-teal" style="width: 75%;">
            <?php
            if ($_SERVER['REQUEST_URI'] == '/import_product') {
            ?>
                <h4 class="text-center my-4 text-primary">Inventory Report</h4>
                <table class="table table-sm table-hover mt-4" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid #007bff; overflow: hidden; font-size: 0.9rem;">
                    <thead style="background-color: #f8f9fa; color: #343a40;">
                        <tr>
                            <th style="padding: 8px; text-align: center;">Product Name</th>
                            <th style="padding: 8px; text-align: center;">Quantity</th>
                            <th style="padding: 8px; text-align: center;">Category</th>
                            <th style="padding: 8px; text-align: center;">Brand</th>
                            <th style="padding: 8px; text-align: center;">Price</th>
                            <th style="padding: 8px; text-align: center;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exports as $export) : ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo htmlspecialchars($export['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center align-middle"><?php echo htmlspecialchars($export['quantity'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center align-middle"><?php echo htmlspecialchars($export['category'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center align-middle"><?php echo htmlspecialchars($export['brand'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center align-middle"><?php echo htmlspecialchars($export['price'], ENT_QUOTES, 'UTF-8'); ?>$</td>
                                <td class="text-center align-middle"><?php echo htmlspecialchars($export['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo '<h1>Welcome to the Inventory System</h1>';
                echo htmlspecialchars($_SESSION['user']['name'], ENT_QUOTES, 'UTF-8');
            }
            ?>
        </div>
    </div>
</div>
