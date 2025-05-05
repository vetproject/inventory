<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';

$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

$categories = countCategories();
$products = countProducts($userId);
$sumPrice = sumPrice($userId);
$total = countLessQuantity($userId);
$less = getLessQuantity($userId);
$totalPriceDate = getPriceByDate($userId);
$productDate = getProductDate($userId);



?>

<div class="container m-0" style="height: 88vh; overflow-y: auto;">
    <div class="row mt-4 mb-3" style="height: 20%;">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 text-center h-100 bg-dark">
                <div class="card-body text-white">
                    <h6 class="card-title text-uppercase text-muted">Categories</h6>
                    <h4 class="card-text"><?php echo $categories ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 text-center h-100 bg-dark">
                <div class="card-body text-white">
                    <h6 class="card-title text-uppercase text-muted">Products</h6>
                    <h4 class="card-text"><?php echo $products ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 text-center h-100 bg-dark">
                <div class="card-body text-white">
                    <h6 class="card-title text-uppercase text-muted">Total Price</h6>
                    <h4 class="card-text"><?php echo $sumPrice ?>$</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 text-center h-100 bg-dark">
                <div class="card-body text-white">
                    <h6 class="card-title text-uppercase text-muted">Low In Stock</h6>
                    <h4 class="card-text"><?php echo $total ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php
            include 'views/graphs/priceDate.php';
            ?>
        </div>
        <div class="bg-dark p-2 mb-4">
            <div class="btn-group btn-group-sm" role="group" aria-label="Filter Options">
                <button type="button" class="btn btn-outline-light btn-sm rounded-pill" id="filterDay1">Day</button>
                <button type="button" class="btn btn-outline-light btn-sm rounded-pill" id="filterMonth1">Month</button>
                <button type="button" class="btn btn-outline-light btn-sm rounded-pill" id="filterYear1">Year</button>
            </div>
            <canvas id="productDate" style="max-height: 100%;"></canvas>
        </div>

    </div>

    <div class="card shadow-sm border-0 text-center bg-dark">
        <div class="card-body text-white">
            <h5 class="card-title ">Low Stock Products</h5>
            <?php if (!empty($less)): ?>
                <ul class="list-group list-group-flush small">
                    <?php foreach ($less as $item): ?>
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between p-1">
                            <span style="font-size: 0.85rem;"><?php echo $item['name'] ?></span>
                            <span class="badge bg-danger" style="font-size: 0.75rem;"><?php echo $item['quantity'] ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-white" style="font-size: 0.85rem;">No low stock products.</p>
            <?php endif; ?>

        </div>



    </div>
    <script src="path/to/your/js/file.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('productDate').getContext('2d');
            let chart = null;

            // Initial chart data
            const initialData = <?php echo json_encode($productDate); ?>;

            // Function to group data by a given period (day, month, year)
            function groupData(data, period) {
                return data.reduce((acc, item) => {
                    let date;
                    const dateObj = new Date(item.date);

                    if (period === 'day') {
                        date = dateObj.toISOString().split('T')[0]; // 'YYYY-MM-DD'
                    } else if (period === 'month') {
                        date = `${dateObj.getFullYear()}-${dateObj.getMonth() + 1}`; // 'YYYY-MM'
                    } else if (period === 'year') {
                        date = `${dateObj.getFullYear()}`; // 'YYYY'
                    }

                    if (!acc[date]) {
                        acc[date] = 0;
                    }
                    acc[date] += item.quantity;
                    return acc;
                }, {});
            }

            // Function to update the chart
            function updateChart(data, period) {
                const groupedData = groupData(data, period);
                const labels = Object.keys(groupedData);
                const chartData = Object.values(groupedData);

                if (chart) {
                    chart.destroy(); // Destroy existing chart before creating a new one
                }

                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: `Quantity by ${period.charAt(0).toUpperCase() + period.slice(1)}`,
                            data: chartData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: period.charAt(0).toUpperCase() + period.slice(1)
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Quantity'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Initialize chart with 'Day' view
            updateChart(initialData, 'day');

            // Filter button event listeners
            document.getElementById('filterDay1').addEventListener('click', () => updateChart(initialData, 'day'));
            document.getElementById('filterMonth1').addEventListener('click', () => updateChart(initialData, 'month'));
            document.getElementById('filterYear1').addEventListener('click', () => updateChart(initialData, 'year'));
        });
    </script>
</div>