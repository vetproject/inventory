<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';

$exports = getAllExports();
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
                <h4 class="text-center">Inventory Report</h4>
            <?php

                if ($exports) {
                    echo '<div class="list-group">';
                    foreach ($exports as $index => $export) {
                        echo '<a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#exportModal-' . $index . '">';
                        echo '<div>';
                        echo '<h6 class="mb-1 font-weight-bold">' . htmlspecialchars(ucwords($export['description'])) . ' (' . htmlspecialchars($export['created_at']) . ')</h6>';
                        echo '</div>';
                        echo '<span>' . htmlspecialchars(date('Y-m-d', strtotime($export['created_at']))) . '</span>';
                        echo '</a>';

                        // Modal for export details
                        echo '<div class="modal fade" id="exportModal-' . $index . '" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel-' . $index . '" aria-hidden="true">';
                        echo '<div class="modal-dialog" role="document">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="exportModalLabel-' . $index . '">' . htmlspecialchars(ucwords($export['description'])) . ' Details</h5>';
                        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                        echo '</button>';
                        echo '</div>';
                        echo '<div class="modal-body">';

                        $products = json_decode($export['products'], true);
                        if (is_array($products)) {
                            echo '<table class="table table-bordered">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Name</th>';
                            echo '<th>Quantity</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            foreach ($products as $product) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($product['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($product['name']) . '</td>';
                                echo '<td>' . htmlspecialchars($product['count']) . '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p class="text-danger">Invalid product data.</p>';
                        }

                        echo '</div>';
                        echo '<div class="modal-footer">';
                        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<p>No data available.</p>';
            }
            ?>
        </div>
    </div>
</div>