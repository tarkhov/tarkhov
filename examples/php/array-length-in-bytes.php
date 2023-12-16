<?php
$array = [1, 2, 3];
$json = json_encode($array); // JSON_PRETTY_PRINT for multiline json formatting
echo mb_strlen($json, '8bit') . " bytes\n";

// for multidimensional array
$array = [['a','b','c'], ['e','f','g']];
$json = json_encode($array, JSON_FORCE_OBJECT); // JSON_PRETTY_PRINT | JSON_FORCE_OBJECT for multiline json formatting
echo mb_strlen($json, '8bit') . " bytes\n";