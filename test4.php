<?php
/**
 * 闭包和匿名函数
 */
$closure = function ($name) {
    return sprintf('Hello %s', $name);
};

echo $closure("Josh");

echo gettype($closure);

if ($closure instanceof Closure) { //闭包是Closure的实例
    echo PHP_EOL, "ok", PHP_EOL;
}

$numberPlusOne = array_map(function ($number) {
    return $number**2;
}, [1, 2, 3]);

print_r($numberPlusOne);

//附加状态 使用use关键字附加闭包状态 php闭包附加并封装状态
function enclosePerson($name) {
    return function ($doCommand) use ($name) {
        return sprintf('%s, %s', $name, $doCommand);
    }; 
}

$clay = enclosePerson('Clay');
echo $clay('get me sweet tea!');