<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';

$categories = countCategories();
$products = countProducts();
$sumPrice = sumPrice();
?>



<body style="background-color: #f8f9fa; font-family: Arial, sans-serif; overflow-x: hidden;">
    <div class="container m-0">
        <div class="row mt-4 mb-3" style="height: 20%;">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 text-center h-100 bg-dark">
                    <div class="card-body text-white">
                        <h5 class="card-title ">Categories</h5>
                        <h3 class="card-text"><?php echo $categories ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 text-center h-100 bg-dark" >
                    <div class="card-body text-white">
                        <h5 class="card-title ">Products</h5>
                        <h3 class="card-text"><?php echo $products ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 text-center h-100 bg-dark" >
                    <div class="card-body text-white">
                        <h5 class="card-title ">Total Price</h5>
                        <h3 class="card-text"><?php echo $sumPrice ?>$</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 text-center h-100 bg-dark" >
                    <div class="card-body text-white">
                        <h5 class="card-title ">Followers</h5>
                        <h3 class="card-text">+245</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-dark" style="height:70%;">

        </div>
        
    </div>
    <script src="path/to/your/js/file.js"></script>
</body>