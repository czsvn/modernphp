<?php
/**
 * generator
 */
function myGenerator()
{
    yield 'value1';
    yield 'value2';
    yield 'value3';
}

while($value = myGenerator()) {
    echo $value . PHP_EOL;
}