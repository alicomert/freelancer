<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$tables = DB::select('SHOW TABLES');
$tableList = array_map('current', $tables);
file_put_contents('table_list.txt', implode(\PHP_EOL, $tableList));
?>