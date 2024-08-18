<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'phpqrcode//phpqrcode/qrlib.php';  // Include the QR Code library

// Define the juice center menu
$menu = "Shree Gajanana Juice Center
Juice Center Menu:
1. Orange Juice - Rs50.00
2. Apple Juice - Rs40.00
3. Mango Juice - Rs60.00
4. Pineapple Juice - Rs50.00
5. Mixed Fruit Juice - Rs70.0
";

// Generate QR code
$filename = 'qrcode.png';  // Name of the generated file

// Adjust the size of the QR code
$matrixPointSize = 2;  // Size of each module (block) in the QR code (smaller value for a smaller QR code)

QRcode::png($menu, $filename, QR_ECLEVEL_L, $matrixPointSize);  // Generate the QR code and save it

// Display the QR code
header('Content-Type: image/png');
readfile($filename);
?>
