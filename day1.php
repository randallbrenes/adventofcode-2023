<?php
include("TrebuchetClass.php");

$inputFile = "day1.txt"; // define input file path

$trebuchet = new TrebuchetClass($inputFile); // create class
// get calibration number (by default version 1) only get digits on text file
echo "Exercise #1: " . $trebuchet->getTotalCalibrationValues() . "\n";

// change the version to exercise #2
$trebuchet->setVersion(2);

// get calibration number evaluating number names as digits
echo "Exercise #2: " . $trebuchet->getTotalCalibrationValues() . "\n";
