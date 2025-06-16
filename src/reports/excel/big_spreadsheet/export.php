<?php
// echo "export big template<br>";
$type = isset($_GET['type']) ? $_GET['type'] : 'CSV';
// echo "type=$type<br>";
// return;
include "MyReport.php";
$report = new MyReport;
$report->run();

if ($type === 'XLSX') {
    $report->exportToXLSX('MyReportSpreadsheet')
    ->toBrowser("MyReport.xlsx");
} elseif ($type === 'ODS') {
    $report->exportToODS('MyReportSpreadsheet')
    ->toBrowser("MyReport.ods");
} elseif ($type === 'CSV') {
    $report->exportToCSV('MyReportSpreadsheet')
    ->toBrowser("MyReport.csv");
}
