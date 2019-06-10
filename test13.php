<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('my-app-name');
$log->pushHandler(new StreamHandler('data.log', Logger::WARNING));

$log->critical("system error");
