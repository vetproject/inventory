<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!isset($_POST['filtered_data'])) {
    die('No data sent');
}

$data = json_decode($_POST['filtered_data'], true);

if (!is_array($data)) {
    die('Invalid data format');
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header
$headers = ['Product Name', 'Quantity', 'Category', 'Brand', 'Description', 'Date'];
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $col++;
}

// Fill data
$row = 2;
foreach ($data as $item) {
    $sheet->setCellValue("A$row", $item['name']);
    $sheet->setCellValue("B$row", $item['quantity']);
    $sheet->setCellValue("C$row", $item['category']);
    $sheet->setCellValue("D$row", $item['brand']);
    $sheet->setCellValue("E$row", $item['des']);
    $sheet->setCellValue("F$row", $item['created_at']);
    $row++;
}

// Send Excel file to browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="filtered_inventory.xlsx"');
header('Cache-Control: max-age=0');

if (ob_get_length()) ob_end_clean();
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
