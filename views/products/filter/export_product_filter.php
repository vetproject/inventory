<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once __DIR__ . '/../../../vendor/autoload.php';

if (!isset($_POST['filtered_data'])) {
    die("No data provided.");
}

$data = json_decode($_POST['filtered_data'], true);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers
$sheet->setCellValue('A1', '#');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Qty');
$sheet->setCellValue('D1', 'Date');

$row = 2;
foreach ($data as $index => $item) {
    $sheet->setCellValue("A$row", $index + 1);
    $sheet->setCellValue("B$row", $item['name']);
    $sheet->setCellValue("C$row", $item['count']);
    $sheet->setCellValue("D$row", $item['created_at']);
    $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="filtered_inventory.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
