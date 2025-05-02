<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Fetch exports
$exports = getAllExports();

// Process exports
$allProducts = [];
if ($exports) {
    foreach ($exports as $export) {
        $products = json_decode($export['products'], true);
        if (is_array($products)) {
            foreach ($products as $product) {
                $product['created_at'] = $export['created_at'];
                $allProducts[] = $product;
            }
        }
    }
}
require_once 'layouts/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <aside class="d-none d-md-block bg-light sidebar bg-warning" style="width:25%;">
            <?php require_once 'layouts/navbar.php'; ?>
        </aside>
        <div class="bg-teal pl-3 pr-3 pt-2" style="width: 75%; height: 80vh; overflow-y: auto;">
            <h4 class="text-center">Inventory Report</h4>

            <!-- Filters -->
            <div class="row row-cols-1 row-cols-md-3 g-2 mb-2 p-2">
                <div class="col">
                    <input type="text" id="searchProduct" class="form-control form-control-sm" placeholder="Search product name...">
                </div>
                <div class="col">
                    <input type="date" id="startDate" class="form-control form-control-sm">
                </div>
                <div class="col">
                    <input type="date" id="endDate" class="form-control form-control-sm">
                </div>
            </div>

            <!-- Export Form -->
            <form id="exportForm" method="post" action="views/products/filter/export_product_filter.php">
                <input type="hidden" name="filtered_data" id="filteredData">
                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-success btn-sm">Export Filtered</button>
                </div>
            </form>

            <!-- Table -->
            <?php if (!empty($allProducts)): ?>
                <div class="table-responsive">
                    <table id="productTable" class="table table-sm table-bordered text-center">
                        <thead class="thead-light">
                            <tr><th>#</th><th>Name</th><th>Qty</th><th>Date</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allProducts as $index => $product): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($product['name']) ?></td>
                                    <td><?= htmlspecialchars($product['count']) ?></td>
                                    <td><?= htmlspecialchars(date('Y-m-d', strtotime($product['created_at']))) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">No data available.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    function filterTable() {
        const searchText = $('#searchProduct').val().toLowerCase();
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();

        $('#productTable tbody tr').each(function () {
            const name = $(this).find('td:nth-child(2)').text().toLowerCase();
            const date = $(this).find('td:nth-child(4)').text();

            const matchName = name.includes(searchText);
            const matchDate = (!startDate || date >= startDate) && (!endDate || date <= endDate);

            $(this).toggle(matchName && matchDate);
        });
    }

    $('#searchProduct, #startDate, #endDate').on('input change', filterTable);

    $('#exportForm').submit(function (e) {
        const filteredRows = [];
        $('#productTable tbody tr:visible').each(function () {
            filteredRows.push({
                name: $(this).find('td:nth-child(2)').text(),
                count: $(this).find('td:nth-child(3)').text(),
                created_at: $(this).find('td:nth-child(4)').text()
            });
        });

        if (filteredRows.length === 0) {
            alert("No data to export.");
            e.preventDefault();
            return;
        }

        $('#filteredData').val(JSON.stringify(filteredRows));
    });
});
</script>
