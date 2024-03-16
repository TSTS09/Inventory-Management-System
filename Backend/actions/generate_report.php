<?php
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

$sql = "SELECT p.product_name, s.supplier_name, c.category_name , i.next_supply_date 
        FROM products p
        INNER JOIN inventorytracking i ON p.product_id = i.product_id 
        INNER JOIN suppliers s ON p.supplier_id = s.supplier_id
        INNER JOIN categories c ON p.category_id = c.category_id";
$result = mysqli_query($conn, $sql); 


if (!$stmt) {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit();
}

// (No user input involved in this query, so binding is not needed)

$result = mysqli_execute($stmt); // Execute the prepared statement

if (!$result) {
  echo "Error executing statement: " . mysqli_error($conn);
  exit();
} else {
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

      $days = daysUntilRestock($row['next_supply_date']);

      $reportData[] = array(
        "product_name" => $row['product_name'],
        "supplier_name" => $row['supplier_name'],
        "category_name" => $row['category_name'],
        "days_until_restock" => $days,
      );
    }
  } else {
    echo "No data found in tables.";
  }
}
echo "oekgfpwokg";
// Generate PDF report (using FPDF library)
require_once '../functions/fpdf/fpdf.php';

$pdf = new FPDF();


$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Inventory Report - ' . date('Y-m-d'), 0, 1, 'C');

// Create table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 6, 'Product Name', 1, 0, 'C');
$pdf->Cell(60, 6, 'Supplier Name', 1, 0, 'C');
$pdf->Cell(40, 6, 'Category', 1, 0, 'C');
$pdf->Cell(40, 6, 'Days Until Restock', 1, 1, 'C');

// Loop through data and populate table rows
$pdf->SetFont('Arial', '', 10);
foreach ($reportData as $row) {
  $pdf->Cell(60, 6, $row['product_name'], 1, 0);
  $pdf->Cell(60, 6, $row['supplier_name'], 1, 0);
  $pdf->Cell(40, 6, $row['category_name'], 1, 0);
  $pdf->Cell(40, 6, $row['days_until_restock'], 1, 1);
}

$pdf->Output('Inventory_Report.pdf', 'D'); // Download the PDF

?>