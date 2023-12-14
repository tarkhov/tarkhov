<?php
// https://stackoverflow.com/questions/9018651/php-get-arrays-data-size
$a1 = [1, 2, 3];
$j1 = json_encode($a, JSON_PRETTY_PRINT);
echo mb_strlen($j1, '8bit');

// for multidimensional array
$a2 = [['a','b','c'], ['e','f','g']];
$j2 = json_encode($a2, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);
echo mb_strlen($j2, '8bit');