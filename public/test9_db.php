<?php
/**
 * PDO 事务
 */
include '../settings.php';

try {
    $pdo = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s;charset=%s',
            $settings['host'],
            $settings['name'],
            $settings['port'],
            $settings['charset'],
            ),
        $settings['username'],
        $settings['password']
        );
} catch (Exception $e) {
    echo 'Database connection failed';
    exit;
}

$stmtSubstract = $pdo->prepare('
    UPDATE accounts
    SET amount = amount - :amount
    WHERE name = :name
');
$stmtAdd = $pdo->prepare('
    UPDATE accounts
    SET amount = amount + :amount
    WHERE name = :name
');

$pdo->beginTransaction();

$fromAccount = 'Checking';
$withDrawal = 50;
$stmtSubstract->bindParam(':name', $fromAccount);
$stmtSubstract->bindParam(':amount', $withDrawal);
$stmtSubstract->execute();

$toAccount = 'Savings';
$deposit = 50;
$stmtAdd->bindParam(':name', $toAccount);
$stmtAdd->bindParam(':amount', $deposit, PDO::PARAM_INT);
$stmtAdd->execute();

$pdo->commit();