<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';

$categories = countCategories();
$products = countProducts();

?>

<body style="background-color: #f8f9fa; font-family: Arial, sans-serif; overflow-x: hidden;">
    <div class="container m-0">
        <div class="row mt-4 mb-3" style="height: 30%;">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 text-center h-100" style="background-color: #fff3cd;">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Categories</h5>
                        <h3 class="card-text"><?php echo $categories ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 text-center h-100" style="background-color: #d4edda;">
                    <div class="card-body">
                        <h5 class="card-title text-success">Products</h5>
                        <h3 class="card-text"><?php echo $products ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 text-center h-100" style="background-color: #f8d7da;">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Fixed Issues</h5>
                        <h3 class="card-text">75</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 text-center h-100" style="background-color: #d1ecf1;">
                    <div class="card-body">
                        <h5 class="card-title text-info">Followers</h5>
                        <h3 class="card-text">+245</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-dark" style="height:60%;">

        </div>
        
    </div>
    <script src="path/to/your/js/file.js"></script>
</body>