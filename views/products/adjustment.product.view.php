<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$userId = $_SESSION['user']['id'] ?? null;

// Fetch all data
$exports = getAllreportsAdjust($userId);

require_once 'layouts/header.php';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container-fluid">
    <div class="row">
        <aside class="d-none d-md-block bg-light sidebar bg-warning" style="width:25%;">
            <?php require_once 'layouts/navbar.php'; ?>
        </aside>

        <div class="bg-teal" style="width: 75%;">
            <h4 class="text-center my-4 text-primary">Inventory Report</h4>

            <!-- Filters -->
            <div class="row row-cols-1 row-cols-md-3 g-2 align-items-center mb-3 m-3 p-2 rounded">
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="text" id="searchProduct" class="form-control border-secondary" placeholder="🔍 Search by product name">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="date" id="startDate" class="form-control border-secondary" placeholder="Start Date">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="date" id="endDate" class="form-control border-secondary" placeholder="End Date">
                    </div>
                </div>
            </div>

            <!-- Export Button -->
            <div class="d-flex justify-content-end align-items-center my-3 px-4">
                <button id="exportBtn" class="btn btn-success btn-sm">Export to Excel</button>
            </div>

            <!-- Table -->
            <div style="max-height: 400px; overflow-y: auto;">
                <table id="inventoryTable" class="table table-sm table-hover mt-2" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid #007bff;">
                    <thead style="background-color: #f8f9fa; color: #343a40;">
                        <tr>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exports as $export): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars(ucfirst($export['name'])) ?></td>
                                <td class="text-center"><?= htmlspecialchars($export['quantity']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($export['category']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($export['brand']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($export['des']) ?></td>
                                <td class="text-center"><?= htmlspecialchars(date('Y-m-d', strtotime($export['created_at']))) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Filter and Export Scripts -->
<script>
    $(document).ready(function () {
        // Live filter
        $('#searchProduct, #startDate, #endDate').on('input change', function () {
            const search = $('#searchProduct').val().toLowerCase();
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();

            $('#inventoryTable tbody tr').each(function () {
                const name = $(this).find('td:nth-child(1)').text().toLowerCase();
                const date = $(this).find('td:nth-child(6)').text();

                const matchName = name.includes(search);
                const matchDate = (!startDate || date >= startDate) && (!endDate || date <= endDate);

                $(this).toggle(matchName && matchDate);
            });
        });

        // Export filtered table to Excel
        $('#exportBtn').on('click', function () {
            const rows = [];

            $('#inventoryTable tbody tr:visible').each(function () {
                rows.push({
                    name: $(this).find('td:nth-child(1)').text(),
                    quantity: $(this).find('td:nth-child(2)').text(),
                    category: $(this).find('td:nth-child(3)').text(),
                    brand: $(this).find('td:nth-child(4)').text(),
                    des: $(this).find('td:nth-child(5)').text(),
                    created_at: $(this).find('td:nth-child(6)').text()
                });
            });

            if (rows.length === 0) {
                alert("No data to export!");
                return;
            }

            const form = $('<form>', {
                method: 'POST',
                action: 'views/products/filter/export_filtered.php'
            });

            $('<input>', {
                type: 'hidden',
                name: 'filtered_data',
                value: JSON.stringify(rows)
            }).appendTo(form);

            $('body').append(form);
            form.submit();
            form.remove();
        });
    });
</script>
