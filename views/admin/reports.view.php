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
            if ($_SERVER['REQUEST_URI'] == '/view_reports') {
                // Add your admin-specific content here
                ?>
                <h1 class="text-center">Inventory Report</h1>
                <?php
                // Function to fetch the report data
                function getInventoryReport() {
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
                    echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<tr class="text-center">';
                    echo '<th>Item</th>';
                    echo '<th>Quantity</th>';
                    echo '<th>Price</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($reportData as $item) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($item['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($item['quantity']) . '</td>';
                        echo '<td>' . htmlspecialchars($item['price']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
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