<?php
$pythonScript = './python/Data.py';

$output = [];
$return_var = 0;

exec("python3 $pythonScript 2>&1", $output, $return_var);