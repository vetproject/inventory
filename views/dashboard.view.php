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

        <div class="bg-teal" style="width: 75%;">
            <?php
            if ($_SERVER['REQUEST_URI'] == '/dashboard') {
            // Add your admin-specific content here
            include 'views/admin/dashbaord.admin.view.php';
            } else {
            // Add your default content here
            echo '<h1>Welcome to the </h1>';
            }
            ?>
        </div>
    </div>
</div>