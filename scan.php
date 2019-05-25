<?php
require "vendor/autoload.php";

//2. 实例 Guzzle HTTP客户端
$client = new \GuzzleHttp\Client();

//3。 打开并迭代处理CSV
$filename = "data.csv";
//$argv[1]
// $csv = new \League\Csv\Reader($filename);
$fp = fopen($filename, "r");
// foreach ($csv as $csvRow) {
// foreach (fgetcsv($fp) as $csvRow) {
while ($row = fgetcsv($fp)) {
    try {
        $httpResponse = $client->options($row[0]);
        
        if ($httpResponse->getStatusCode() >= 400) {
            throw new \Exception();
        }
    } catch (\Exception $e) {
        echo $row[0] . PHP_EOL;
    }
}
