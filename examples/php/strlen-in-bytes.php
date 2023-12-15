<?php
// https://stackoverflow.com/questions/9018651/php-get-arrays-data-size
$array = [1, 2, 3];
$json = json_encode($array, JSON_PRETTY_PRINT);
echo mb_strlen($json, '8bit') . "\n";

// for multidimensional array
$array = [['a','b','c'], ['e','f','g']];
$json = json_encode($array, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);
echo mb_strlen($json, '8bit') . "\n";