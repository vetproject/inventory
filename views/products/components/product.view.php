<?php
// Sample data
$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

$products = getAllProducts($userId);

$brands = getBrands();

// get all categories from the database
$categories = getAllCategories();

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="row row-cols-1 row-cols-md-3 g-2 align-items-center mb-3 m-3 bg-secondary p-2 rounded">
    <div class="col">
        <div class="input-group input-group-sm">
            <input type="text" id="searchProduct" class="form-control border-secondary" placeholder="🔍 Search by product name" style="padding-left: 15px;">
        </div>
    </div>
    <div class="col">
        <div class="input-group input-group-sm">
            <label for="filterCategory" class="p-1 input-group-text bg-light text-dark">Category</label>
            <select id="filterCategory" class="form-select border-secondary">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['name']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col">
        <div class="input-group input-group-sm">
            <label for="filterBrand" class="p-1 input-group-text bg-light text-dark">Brand</label>
            <select id="filterBrand" class="form-select border-secondary">
                <option value="">All Brands</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= htmlspecialchars($brand['brand']) ?>"><?= htmlspecialchars($brand['brand']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>



<div class="d-flex justify-content-end m-3">
    <button class="btn btn-success btn-xs export-button" style="font-size: 12px; padding: 3px 6px;"
        data-id="<?= htmlspecialchars($product['id']) ?>" title="Export Product">
        <i class="fas fa-file-export"></i> Export
    </button>
</div>

<div class="container d-flex" style="overflow-y: auto; max-height: 480px;">
    <!-- Left: Table -->
    <div class="w-100 me-2">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr class="text-center" style="font-size: 13px;">
                    <th>No</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No products available.</td>
                    </tr>
                <?php else: ?>
                    <?php $loopIndex = 0; ?>
                    <?php foreach ($products as $product): ?>
                        <tr style="font-size: 12px;">
                            <td class="text-center p-1 align-middle"><?= ++$loopIndex ?></td>
                            <td class="p-1 align-middle"><?= htmlspecialchars($product['name'] ?? '') ?></td>
                            <td class="text-center p-1 align-middle quantity-cell" data-id="<?= htmlspecialchars($product['id'] ?? '') ?>">
                                <?= htmlspecialchars($product['quantity'] ?? '') ?>
                            </td>
                            <td class="text-center p-1 align-middle"><?= htmlspecialchars($product['category'] ?? '') ?></td>
                            <td class="p-1 align-middle"><?= htmlspecialchars($product['brand'] ?? '') ?></td>
                            <td class="p-1 align-middle text-center">
                                <button class="btn btn-warning btn-xs edit-button" style="font-size: 10px; padding: 2px 5px;"
                                    data-id="<?= htmlspecialchars($product['id']) ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>"
                                    data-quantity="<?= htmlspecialchars($product['quantity']) ?>"
                                    data-category="<?= htmlspecialchars($product['category']) ?>"
                                    data-brand="<?= htmlspecialchars($product['brand']) ?>"
                                    data-price="<?= htmlspecialchars($product['price']) ?>" title="Edit Product">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <button class="btn btn-danger btn-xs decreaseProduct" style="font-size: 10px; padding: 2px 5px; display: none;" title="Decrease Quantity"
                                    data-id="<?= htmlspecialchars($product['id']) ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>">
                                    <i class="fas fa-minus-circle"></i> Decrease
                                </button>
                                <button class="btn btn-primary btn-xs addProduct" style="font-size: 10px; padding: 2px 5px; display: none;" title="Increase Quantity"
                                    data-id="<?= htmlspecialchars($product['id']) ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>">
                                    <i class="fas fa-plus-circle"></i> Add
                                </button>
                                <button class="btn btn-info btn-xs view-button adjust-button" style="font-size: 10px; padding: 2px 5px;" title="Adjust Product"
                                    data-id="<?= htmlspecialchars($product['id']) ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>"
                                    data-quantity="<?= htmlspecialchars($product['quantity']) ?>"
                                    data-category="<?= htmlspecialchars($product['category']) ?>"
                                    data-brand="<?= htmlspecialchars($product['brand']) ?>"
                                    data-price="<?= htmlspecialchars($product['price']) ?>">
                                    <i class="fas fa-sliders-h"></i> Adjust
                                </button>
                                <button class="btn btn-success btn-xs add-product-btn" style="font-size: 10px; padding: 2px 5px;" title="Add Product"
                                    data-id="<?= htmlspecialchars($product['id']) ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>"
                                    data-quantity="<?= htmlspecialchars($product['quantity']) ?>"
                                    data-category="<?= htmlspecialchars($product['category']) ?>"
                                    data-brand="<?= htmlspecialchars($product['brand']) ?>"
                                    data-price="<?= htmlspecialchars($product['price']) ?>">
                                    <i class="fas fa-plus-circle"></i> Add
                                </button>

                                <form class=" delete-button" method="POST" action="controllers/products/delete.product.controller.php" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                                    <button type="submit" class="btn btn-danger btn-xs" style="font-size: 10px; padding: 2px 5px;" title="Delete Product">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Right: Navigation View -->
    <div id="exportView" class="ml-2" style="width:350px; height: auto; background-color: lightgray; padding: 15px; border-radius: 5px; border: 1px solid #6c757d; display: none;">
        <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 1.2rem; border: none; background: transparent;">
            <p class="text-center mb-0">Export Products</p>
            <button class="btn-close text-danger" id="closeExportView" aria-label="Close" style="font-size: 1.2rem; border: none; background: transparent;">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <table class="table table-sm">
            <thead>
                <tr class=" text-center" style="font-size: 11px;">
                    <th>No</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody id="exportedProductsList">
            </tbody>
        </table>
        <div class="d-flex justify-content-center align-items-center">

            <form method="POST" action="controllers/products/export.product.controller.php">
                <input type="text" name="description" require class="form-control form-control-sm mb-2" placeholder="Enter description" style="font-size: 12px;">
                <input type="hidden" name="userId" value="<?= htmlspecialchars($userId) ?>">
                <input type="hidden" name="exportedProducts" id="exportedProductsInput">
                <button style="font-size: 10px;" class="btn btn-primary btn-sm  m-1" id="exportProducts">Export</button>
            </form>
        </div>
    </div>
</div>

<!-- Add More Quantity Products Modal ---------------------------------------->
<div class="modal fade" id="addMoreProductModal" tabindex="-1" aria-labelledby="addMoreProductModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMoreProductModalLabel">Add More Product</h5>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.2rem; border: none; background: transparent;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMoreProductForm" method="POST" action="controllers/products/add.quantity.product.controller.php">
                    <input type="hidden" name="id" id="addMoreProductId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addMoreProductName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="addMoreProductName" name="name" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addMoreProductQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="" placeholder="Enter the quantity you wish to add more" name="quantity" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addMoreProductCategory" class="form-label">Category</label>
                            <input type="text" class="form-control" id="addMoreProductCategory" name="category" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addMoreProductBrand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="addMoreProductBrand" name="brand" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addMoreProductPrice" class="form-label">Price</label>
                            <input type="text" class="form-control" id="" placeholder="Enter product price" name="price" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($userId) ?>">
                            <input type="hidden" name="old_quantity" id="old_quantity">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.add-product-btn').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const quantity = $(this).data('quantity');
            const category = $(this).data('category');
            const brand = $(this).data('brand');
            const price = $(this).data('price');
            const oldQuantity = $(this).data('quantity');

            $('#addMoreProductId').val(id);
            $('#addMoreProductName').val(name);
            $('#addMoreProductQuantity').val(quantity);
            $('#addMoreProductCategory').val(category);
            $('#addMoreProductBrand').val(brand);
            $('#addMoreProductPrice').val(price);
            $('#old_quantity').val(oldQuantity);

            $('#addMoreProductModal').modal('show');
        });
    });
</script>

<!-- add more quantity products ----------------------------------------->


<!-- Adjust Product Modal JS -------------------------------------------->

<div class="modal fade" id="adjustProductModal" tabindex="-1" aria-labelledby="adjustProductModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="adjustProductForm" method="POST" action="controllers/products/adjust.product.controller.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="adjustProductModalLabel">Adjust Product</h5>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.2rem; border: none; background: transparent;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="adjustProductId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="adjustProductName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="adjustProductName" name="name" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="adjustProductQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="adjustProductQuantity" name="quantity" required>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="adjustProductOldQuantity" name="old_quantity" readonly>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="adjustProductCategory" class="form-label">Category</label>
                            <input type="text" class="form-control" id="adjustProductCategory" name="category" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="adjustProductBrand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="adjustProductBrand" name="brand" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="adjustProductPrice" class="form-label">Price</label>
                            <input type="text" class="form-control" id="adjustProductPrice" name="price" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="adjustProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="adjustProductDescription" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($userId) ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.adjust-button').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const quantity = $(this).data('quantity');
            const category = $(this).data('category');
            const brand = $(this).data('brand');
            const price = $(this).data('price');
            const oldQuantity = $(this).data('quantity');

            $('#adjustProductId').val(id);
            $('#adjustProductName').val(name);
            $('#adjustProductQuantity').val(quantity);
            $('#adjustProductOldQuantity').val(oldQuantity);
            $('#adjustProductCategory').val(category);
            $('#adjustProductBrand').val(brand);
            $('#adjustProductPrice').val(price);

            $('#adjustProductModal').modal('show');
        });
    });
</script>

<!-- Adjust Product Modal JS ----------------------------------------->

<!-- Edit Product Modal ---------------------------------------------->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProductForm" method="POST" action="controllers/products/edit.product.controller.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.2rem; border: none; background: transparent;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editProductId">
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editProductName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="editProductQuantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductCategory" class="form-label">Category</label>
                        <div class="input-group input-group-sm">
                            <select id="editProductCategory" name="category" class="form-select border-secondary" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['name']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editProductBrand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="editProductBrand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="editProductPrice" name="price" required>
                    </div>
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($userId) ?>">
                    <input type="hidden" name="old_quantity" id="old_quantity">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const quantity = $(this).data('quantity');
            const category = $(this).data('category');
            const brand = $(this).data('brand');
            const price = $(this).data('price');

            $('#editProductId').val(id);
            $('#editProductName').val(name);
            $('#editProductQuantity').val(quantity);
            $('#editProductCategory').val(category);
            $('#editProductBrand').val(brand);
            $('#editProductPrice').val(price);
            $('#old_quantity').val(quantity);

            $('#editProductModal').modal('show');
        });
    });
</script>
<!-- Edit Product Modal JS ----------------------------------------->

<!-- js for export product -------------------------------------------->
<script>
    $(document).ready(function() {
        let productList = {};

        $('.addProduct').on('click', function() {
            const productId = $(this).data('id');
            const productName = $(this).data('name');
            const quantityCell = $(`.quantity-cell[data-id="${productId}"]`);

            if (!productList[productId]) {
                productList[productId] = {
                    id: productId,
                    name: productName,
                    count: 1
                };
                $('#exportedProductsList').append(`
                    <tr id="productRow-${productId}" style="font-size: 10px;">
                        <td class="text-center">${Object.keys(productList).length}</td>
                        <td>${productName}</td>
                        <td class="text-center" id="productCount-${productId}">1</td>
                        <td class="text-center">${productId}</td>
                    </tr>
                `);
            } else {
                productList[productId].count++;
                $(`#productCount-${productId}`).text(productList[productId].count);
            }

            // Update quantity in the product list
            const currentQuantity = parseInt(quantityCell.text());
            quantityCell.text(currentQuantity - 1);

            $('#exportView').show();
        });

        $('.decreaseProduct').on('click', function() {
            const productId = $(this).data('id');
            const quantityCell = $(`.quantity-cell[data-id="${productId}"]`);

            if (productList[productId] && productList[productId].count > 0) {
                productList[productId].count--;
                $(`#productCount-${productId}`).text(productList[productId].count);

                if (productList[productId].count === 0) {
                    delete productList[productId];
                    $(`#productRow-${productId}`).remove();
                }
            }

            // Update quantity in the product list
            const oldQuantity = parseInt(quantityCell.data('old-quantity')) || parseInt(quantityCell.text());
            quantityCell.data('old-quantity', oldQuantity);

            const currentQuantity = parseInt(quantityCell.text());
            if (currentQuantity < oldQuantity) {
                quantityCell.text(currentQuantity + 1);
            }
        });

        $('.export-button').on('click', function() {
            $('.export-button,.edit-button,.view-button,.delete-button,.add-product-btn').hide();
            $('#exportView').show();
            $('.addProduct,.decreaseProduct').show();
        });

        $('#closeExportView').on('click', function() {
            $('.export-button,.edit-button,.view-button,.delete-button,.add-product-btn').show();
            $('.addProduct,.decreaseProduct').hide();
            $('#exportView').hide();
        });

        $('#exportProducts').on('click', function() {
            const exportedProducts = Object.values(productList);
            $('#exportedProductsInput').val(JSON.stringify(exportedProducts));
        });
    });
</script>


<!-- Filter and search functionality -->
<script>
    $(document).ready(function() {
        // Filter and search functionality
        $('#searchProduct, #filterCategory, #filterBrand').on('input change', function() {
            const searchValue = $('#searchProduct').val().toLowerCase();
            const filterValue = $('#filterCategory').val();
            const filterBrandValue = $('#filterBrand').val();

            $('tbody tr').each(function() {
                const productName = $(this).find('td:nth-child(2)').text().toLowerCase();
                const productCategory = $(this).find('td:nth-child(4)').text();
                const productBrand = $(this).find('td:nth-child(5)').text();

                const matchesSearch = productName.includes(searchValue);
                const matchesFilter = filterValue === "" || productCategory === filterValue;
                const matchesBrandFilter = filterBrandValue === "" || productBrand === filterBrandValue;

                if (matchesSearch && matchesFilter && matchesBrandFilter) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>