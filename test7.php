<?php
try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=sakila;port=3307;charset=utf8',
        'root',
        'root'
        );
    $a = 1;
    echo "1";
} catch (Exception $e) {
    echo 'Database connection failed';
    exit;
}