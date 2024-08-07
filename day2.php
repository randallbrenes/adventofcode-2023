<?php
include("CubeConundrumClass.php");

$inputFile = "day2.txt"; // define input file path
$cubeConundrum = new CubeConundrumClass($inputFile); // create class
$cubeConundrum->setMaxValues(12, 13, 14); // define max Red, Green and Blue cubes to consider a valid game

echo "Exercise #1: " . $cubeConundrum->exercise1() . "\n"; // evaluate exercise #1 and get response
echo "Exercise #2: " . $cubeConundrum->exercise2() . "\n"; // evaluate exercise #2 and get response
