<?php
/**
 * 生产环境中用filp/whoops 调试bug
 * page115
 * 异常处理四原则
 * 一定要让PHP报告错误
 * 在开发环境要显示错误
 * 在生产环境不能显示错误
 * 在开发环境和生产环境都要记录错误
 * php.ini 设置 开发环境
 * ;显示错误
 * display_startup_errors = On
 * display_errors = On
 * 
 * ;报告所有错误
 * error_reporting = -1
 * 
 * ;记录错误
 * log_errors = On
 * 
 * 生产环境
 * ;不显示错误
 * display_startup_errors = Off
 * display_errors = Off
 * 
 * ;除了注意事项之外，报告所有其它错误
 * error_reporting = E_ALL &~E_NOTICE
 * 
 * ;记录错误
 * log_errors = On
 * 
 */
set_exception_handler(function (Exception $e) {
    //处理并记录异常
});

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return;
    }
    
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});



restore_error_handler();



