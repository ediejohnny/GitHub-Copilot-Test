<?php

/* This project is a test with our brand new partner, GitHub Copilot.

In Brazil we have a lottery called MegaSena and we can download the results of all the games.
So I decided to make some cool things with GitHub Copilot and test it's capacity to help us.
This file is commented with I wished the Copilot to do to me and an extra comment at the line that
Copilot just fails and I had to do it myself.

I hope this project helps Copilot to improve itself and maybe we can use it in the future trusting it'll
do the right thing, just telling it the basics what we want to build. Thank you! And I hope you enjoy it!
*/

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; // Copilot started using the old version of PhpSpreadsheet, so I had to use the new version.
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

# Read data from megasena_results.xlsx using PhpSpreadsheet
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('megasena_results.xlsx');
$worksheet = $spreadsheet->getActiveSheet();

# Get the data from the worksheet 
$data = $worksheet->toArray();

# Save the data from column 1 to column 6 in an array
$data = array_map(function($row) {
    return array_slice($row, 1, 7);
}, $data);

# Transform the date from brazilian format to american format in the first column
$data = array_map(function($row) {
    $row[0] = str_replace('/', '-', $row[0]); // Copilot mistake, we need this line to make the date format correct
    $row[0] = date('Y-m-d', strtotime($row[0]));
    return $row;
}, $data);

# Copy the data to a new array without the first index
$data2 = array_map(function($row) {
    return array_slice($row, 1);
}, $data);

# Return an array containing all the index of the array that the number 4 appears
$indexes = array_keys(array_filter($data2, function($row) {
    return in_array(4, $row);
}));

# Loop through the indexes and print the date that is on the same index
foreach ($indexes as $index) {
    echo $data[$index][0] . PHP_EOL; // Copilot here already knew that the date were on the first index
}

# Loop through the indexes and print everything that is on the same index
foreach ($indexes as $index) {
    echo implode(', ', $data[$index]) . PHP_EOL; // Now Copilot printed everything because we told it to do that
}