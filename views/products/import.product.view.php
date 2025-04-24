<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';

$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

$exports = getAllreports($userId);
?>
<?php
require_once 'layouts/header.php';
?>
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
                // Add your admin-specific content here
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
                            <th style="padding: 8px; text-align: center;">Created At</th>
                            <th style="padding: 8px; text-align: center;">Actions</th>
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
                                <td class="text-center align-middle">
                                    <button class="btn btn-sm btn-primary edit-btn" data-id="<?php echo htmlspecialchars($export['id'], ENT_QUOTES, 'UTF-8'); ?>" data-name="<?php echo htmlspecialchars($export['name'], ENT_QUOTES, 'UTF-8'); ?>" data-quantity="<?php echo htmlspecialchars($export['quantity'], ENT_QUOTES, 'UTF-8'); ?>" data-category="<?php echo htmlspecialchars($export['category'], ENT_QUOTES, 'UTF-8'); ?>" data-brand="<?php echo htmlspecialchars($export['brand'], ENT_QUOTES, 'UTF-8'); ?>" data-price="<?php echo htmlspecialchars($export['price'], ENT_QUOTES, 'UTF-8'); ?>">Edit</button>
                                    <a href="/delete_product?id=<?php echo htmlspecialchars($export['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php
            } else {
                // Add your default content here
                echo '<h1>Welcome to the </h1>';
                $_SESSION['user']['name'];
            }
            ?>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/update_product.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="edit-quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="edit-category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="edit-brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="edit-price" name="price" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const quantity = this.getAttribute('data-quantity');
            const category = this.getAttribute('data-category');
            const brand = this.getAttribute('data-brand');
            const price = this.getAttribute('data-price');

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-quantity').value = quantity;
            document.getElementById('edit-category').value = category;
            document.getElementById('edit-brand').value = brand;
            document.getElementById('edit-price').value = price;

            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        });
    });
</script>