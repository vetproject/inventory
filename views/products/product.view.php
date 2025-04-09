<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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

        <div class="p-0 m-0" style="width: 75%;">

            <?php
            require_once 'views/products/components/productCategory.view.php';
            require_once 'views/products/components/product.view.php';
            ?>
        </div>
    </div>
</div>