<?php
/**
 * 流上下文
 * @var string $requestBody
 */
$requestBody = '{"username": "josh"}';
$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => "Content-Type: application/json;charset=utf-8;\r\n" .
                    "Content-Length: " . mb_strlen($requestBody),
        'content' => $requestBody
    )
));
$response = file_get_contents('https://my-api.com/users', false, $context);

/**
 * 流过滤器
 * @var Ambiguous $handle
 */
$handle = fopen('data.txt', 'rb');
stream_filter_append($handle, 'string.toupper');
while (feof($handle) !== true) {
    echo fgets($handle);
}
fclose($handle);

//演示使用php://filter附加流过滤器string.toupper
// filter/read=<filter_name>/resource=<scheme>://<target>
$handle = fopen('php://filter/read=string.toupper/resource=data.txt', 'rb');
while (feof($handle) !== true) {
    echo fgets($handle);
}
fclose($handle);

$dataStart = new DateTime();
$dateInterval = DateInterval::createFromDateString('-1 day');
$datePeriod = new DatePeriod($dataStart, $dateInterval, 30);
foreach ($datePeriod as $date) {
    $file = 'sftp://USER:PASS@rsync.net/' . $date->format('Y-m-d') . 'log.bz2';
    if (file_exists($file)) {
        $handle = fopen($file, 'rb');
        stream_filter_append($handle, 'bzip2.decompress');
        while (feof($handle) !== false) {
            $line = fgets($handle);
            if (strpos($line, 'www.example.com') !== false) {
                fwrite(STDOUT, $line);
            }
        }
        fclose($handle);
    }
}
