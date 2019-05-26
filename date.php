<?php
echo date('Y-m-d H:i:s', strtotime('last day of midnight')) . PHP_EOL;

$timezone = new DateTimeZone('Asia/Shanghai');
$date = new DateTime('1999-09-09 11:00', $timezone);
echo $date->format('Y-m-d H:i:s') . PHP_EOL;
$interval = new DateInterval('P2W');
$dateinterval = DateInterval::createFromDateString('-1 day');
$date->add($interval);
echo $date->format('Y-m-d H:i:s') . PHP_EOL;
echo $date->getTimestamp(), PHP_EOL;


$dateStart = new DateTime();
$dateInterval = DateInterval::createFromDateString('-1 day');
$datePeriod = new DatePeriod($dateStart, $dateInterval, 3);
foreach ($datePeriod as $date) {
    echo $date->format('Y-m-d'), PHP_EOL;
}

$dateObj = DateTime::createFromFormat('Y-m-d H:i:s', '1989-08-07 15:45:41');
echo $dateObj->format('Y-m-d H:i:s'), PHP_EOL;