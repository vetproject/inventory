<div class="container mb-3 mt-3">
    <button class="btn btn-primary p-2" style="font-size: 13px; " data-bs-toggle="modal" data-bs-target="#categoryModal">Category</button>
    <button class="btn btn-success p-2" style="font-size: 13px; " data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once __DIR__ . '/../../../models/products/product.model.php'; // Adjusted the path
if (file_exists(__DIR__ . '/../../../models/products/product.model.php')) {
    $categories = getAllCategories();
} else {
    $categories = []; // Fallback to an empty array if the file is missing
}
?>
<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Category Management</h5>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.2rem; border: none; background: transparent;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add Category Form -->
                <form id="addCategoryForm" class="mb-3" method="POST" action="controllers/products/add.category.controller.php">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <label for="categoryName" class="form-label " style="font-size: small;">Category Name:</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter category name" required>
                        </div>
                        <div class="col-auto mt-2">
                            <button type="submit" class="btn btn-primary mt-4 p-2" style="font-size: 12px; padding: 5px;">Add Category</button>
                        </div>
                    </div>
                </form>

                <!-- Category List -->
                <h5 style="font-size: small;">Category List</h5>
                <div style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center p-1 m-0" style="font-size: 13px;">
                                <th>id</th>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryList">
                            <?php foreach ($categories as $index => $category): ?>
                                <tr style="font-size: 12px;">
                                    <td class="p-1 m-0 align-middle text-center"><?= htmlspecialchars($category['id']) ?></td>
                                    <td class="p-1 m-0 align-middle"><?= htmlspecialchars($category['name']) ?></td>
                                    <td class="p-1 m-0 align-middle text-center">
                                        <button class="btn btn-warning btn-xs p-1 edit-category-btn" data-id="<?= htmlspecialchars($category['id']) ?>" data-name="<?= htmlspecialchars($category['name']) ?>" style="font-size: 10px; padding: 2px 5px;">Edit</button>
                                        <form method="POST" action="controllers/products/delete.category.controller.php" style="display: inline;">
                                            <input type="hidden" name="categoryId" value="<?= htmlspecialchars($category['id']) ?>">
                                            <button type="submit" class="btn btn-danger btn-xs p-1" style="font-size: 10px; padding: 2px 5px;">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------------------------------------- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" method="POST" action="controllers/products/edit.category.controller.php">
                    <input type="hidden" id="editCategoryId" name="categoryId">
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name:</label>
                        <input type="text" class="form-control" id="editCategoryName" name="categoryName" required>
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-category-btn');
        const editCategoryModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        const editCategoryId = document.getElementById('editCategoryId');
        const editCategoryName = document.getElementById('editCategoryName');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');

                editCategoryId.value = categoryId;
                editCategoryName.value = categoryName;

                editCategoryModal.show();
            });
        });
    });
</script>


<!---------------------------------------- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product Form</h5>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.2rem; border: none; background: transparent;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" method="POST" action="controllers/products/add.product.controller.php">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name:</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label" style="font-size: 12px;">Category:</label>
                        <div class="input-group input-group-sm">
                            <select class="form-select border-secondary" id="productCategory" name="productCategory" required style="font-size: 12px; height: 35px;">
                                <option value="" disabled selected>Select Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['name']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productBrand" class="form-label">Brand:</label>
                        <input type="text" class="form-control" id="productBrand" name="productBrand">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price:</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required min="0">
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= isset($_SESSION['user']['id']) ? htmlspecialchars($_SESSION['user']['id']) : '' ?>">
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>