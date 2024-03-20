<?php
require_once '../functions/fpdf/fpdf.php';
include '../settings/connection.php'; // Include your database connection script


function daysUntilRestock($next_supply_date) {
  $today = new DateTime(); // Create a DateTime object for today
  $nextSupplyDate = new DateTime($next_supply_date);

  $interval = $nextSupplyDate->diff($today); // Calculate date difference
  $days_until_restock = $interval->days; // Extract the number of days

  if ($days_until_restock < 0) {
    return "overdue";
  } else {
    return $days_until_restock; // Return rounded down number of days (already whole days)
  }
}

// Fetch data from tables
$reportData = [];
$sql = "SELECT p.ProductName AS product_name, i.supplier_contact AS supplier_contact, c.categoryName AS category_name, i.next_supply_date FROM products p LEFT OUTER JOIN inventorytracking i ON p.ProductID = i.product_id LEFT OUTER JOIN categories c ON p.Category = c.categoryid;";

$result = mysqli_query($conn, $sql);

if (!$result) {
  echo "Error executing query: " . mysqli_error($conn);
  exit();
} else {
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

      $days = daysUntilRestock($row['next_supply_date']);

      $reportData[] = array(
        "product_name" => $row['product_name'],
        "supplier_contact" => $row['supplier_contact'],
        "category_name" => $row['category_name'],
        "days_until_restock" => $days,
      );
    }
  } else {
    echo "No data found in tables.";
  }
}

// print_r($reportData);
// exit();

// Generate PDF report (using FPDF library)
ob_end_clean();
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Inventory Report - ' . date('Y-m-d'), 0, 1, 'C');

// Create table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 6, 'Product Name', 1, 0, 'C');
$pdf->Cell(50, 6, 'Supplier Contact', 1, 0, 'C');
$pdf->Cell(40, 6, 'Category', 1, 0, 'C');
$pdf->Cell(40, 6, 'Days Until Restock', 1, 1, 'C');

// Loop through data and populate table rows
$pdf->SetFont('Arial', '', 10);
foreach ($reportData as $row) {
  $pdf->Cell(50, 6, $row['product_name'], 1, 0);
  $pdf->Cell(50, 6, $row['supplier_contact'], 1, 0);
  $pdf->Cell(40, 6, $row['category_name'], 1, 0);
  $pdf->Cell(40, 6, $row['days_until_restock'], 1, 1);
}

// $pdf->Output('Inventory_Report.pdf', 'D'); // Download the PDF
$pdf->Output(); // Download the PDF

?>