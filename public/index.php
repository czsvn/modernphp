<?php
/**
 * 数据库对象 PDO
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

$sql = 'SELECT email FROM sakila.customer WHERE email = :email';
$statement = $pdo->prepare($sql);
$email = filter_input(INPUT_GET, 'email');
$email = 'BARBARA.JONES@sakilacustomer.org';
$statement->bindValue(':email', $email);
$statement->execute();
//迭代结果
// while (($result = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
//     print_r($result);
// }

//把预处理语句获取的行当成对象
// while (($result = $statement->fetchObject()) !== false) {
//     echo $result->email, PHP_EOL;
// }

//一次获取一列的值 $column_number 为所请求的值的索引值如id,email 取email为1
while (($email = $statement->fetchColumn(0)) !== false) {
    echo $email;
}

exit;


// $sql = 'SELECT email FROM sakila.customer WHERE id = :id';
// $statement = $pdo->prepare($sql);

// $userId = filter_input(INPUT_GET, 'id');
// $userId = 8;
// $statement->bindValue(':id', $userId, PDO::PARAM_INT);