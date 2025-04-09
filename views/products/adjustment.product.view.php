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
            if ($_SERVER['REQUEST_URI'] == '/adjustment_product') {
                // Add your admin-specific content here
            ?>
                <h4 class="text-center">Inventory Report</h4>
            <?php
                // Function to fetch the report data
                function getInventoryReport()
                {
                    // Example data, replace with actual data fetching logic
                    return [
                        ['name' => 'Item 1', 'quantity' => 10, 'price' => 100],
                        ['name' => 'Item 2', 'quantity' => 5, 'price' => 50],
                        ['name' => 'Item 3', 'quantity' => 20, 'price' => 200]
                    ];
                }

                // Fetch the report data
                $reportData = getInventoryReport();

                if ($reportData) {
                    echo '<div class="list-group">';
                    foreach ($reportData as $index => $item) {
                        echo '<a href="#" class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#item-details-' . $index . '" aria-expanded="false" aria-controls="item-details-' . $index . '">';
                        echo '<h5 class="mb-1">' . htmlspecialchars($item['name']) . '</h5>';
                        echo '</a>';
                        echo '<div class="collapse" id="item-details-' . $index . '">';
                        echo '<div class="card card-body">';
                        echo '<p class="mb-1">Quantity: ' . htmlspecialchars($item['quantity']) . '</p>';
                        echo '<p class="mb-1">Price: $' . htmlspecialchars($item['price']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No data available.</p>';
                }
            } else {
                // Add your default content here
                echo '<h1>Welcome to the Dashboard</h1>';
            }
            ?>
        </div>
    </div>
</div>