<?php
/**
 * 过滤数据 和验证数据 page 78
 * @var string $email
 * aura/filter
 * respect/validation
 * symfony/validator
 */
$email = 'mar@qq.com';
$filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
echo $filterEmail;

$valiadEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
echo $valiadEmail;
