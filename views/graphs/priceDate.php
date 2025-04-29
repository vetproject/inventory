<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/products/product.model.php';

$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
$totalPriceDate = getPriceByDate($userId);
?>

<div class="bg-dark p-2 mb-4">
    <div class="btn-group btn-group-sm" role="group" aria-label="Filter Options">
        <button type="button" class="btn btn-outline-light btn-sm rounded-pill" id="filterDay">Day</button>
        <button type="button" class="btn btn-outline-light btn-sm rounded-pill" id="filterMonth">Month</button>
        <button type="button" class="btn btn-outline-light btn-sm rounded-pill" id="filterYear">Year</button>
    </div>
    <canvas id="priceByDateChart" style="max-height: 100%;"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('priceByDateChart').getContext('2d');
    const groupedData = <?php
                        $groupedData = [];
                        foreach ($totalPriceDate as $entry) {
                            $date = date('Y-m-d', strtotime($entry['date']));
                            if (!isset($groupedData[$date])) {
                                $groupedData[$date] = 0;
                            }
                            $groupedData[$date] += $entry['price'];
                        }
                        echo json_encode($groupedData);
                        ?>;

    function groupDataBy(filter) {
        const result = {};
        for (const [date, price] of Object.entries(groupedData)) {
            let key;
            if (filter === 'month') {
                key = date.substring(0, 7); // YYYY-MM
            } else if (filter === 'year') {
                key = date.substring(0, 4); // YYYY
            } else {
                key = date; // Default to day
            }
            if (!result[key]) {
                result[key] = 0;
            }
            result[key] += price;
        }
        return result;
    }

    function updateChart(filter) {
        const filteredData = groupDataBy(filter);
        const labels = Object.keys(filteredData);
        const data = Object.values(filteredData);

        priceByDateChart.data.labels = labels;
        priceByDateChart.data.datasets[0].data = data;
        priceByDateChart.update();
    }
    const priceByDateChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Object.keys(groupDataBy('day')),
            datasets: [{
                label: 'Price by Date',
                data: Object.values(groupDataBy('day')),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true // Shows the legend
                },
                tooltip: {
                    enabled: true, // Enables tooltips
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const label = context.label;
                            return `Date: ${label}, Price: ${value}$`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        display: true // Shows y-axis labels
                    },
                    grid: {
                        drawTicks: true, // Shows y-axis ticks
                        drawBorder: true // Shows y-axis border
                    }
                },
                x: {
                    ticks: {
                        display: true // Shows x-axis labels
                    },
                    grid: {
                        drawTicks: true, // Shows x-axis ticks
                        drawBorder: true // Shows x-axis border
                    }
                }
            }
        }
    });

    document.getElementById('filterDay').addEventListener('click', () => updateChart('day'));
    document.getElementById('filterMonth').addEventListener('click', () => updateChart('month'));
    document.getElementById('filterYear').addEventListener('click', () => updateChart('year'));
</script>