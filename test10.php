<?php
echo mb_detect_encoding('中文'), PHP_EOL;
$chinese = '中文';
echo mb_convert_encoding($chinese, 'ascii'), PHP_EOL;

//default_charset = "UTF-8";
//header('Content-Type: application/json;charset=utf-8');