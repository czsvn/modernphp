<?php
/**
 * generator 大型数据集适用 是功能多样性和简洁性之间的折中方案
 */
function myGenerator()
{
    yield 'value1';
    yield 'value2';
    yield 'value3';
}

foreach (myGenerator() as $value) {
    echo $value, PHP_EOL;
}

function makeRange($length) {
    for ($i = 0; $i < $length; $i++) {
        yield $i;
    }
}

foreach (makeRange(100) as $i) {
    echo $i, PHP_EOL;
}

function getRows($file) {
    $handle = fopen($file, 'rb');
    if ($handle === false) {
        throw new Exception();
    }

    while (feof($handle) === false) {
        yield fgetcsv($handle);
    }
    fclose($handle);
}

foreach (getRows('data.csv') as $row) {
    print_r($row);
}

