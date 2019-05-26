<?php
/**
 * 密码hash
 * 非5.5版本以上可用ircmaxell/password-compat
 */
try {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (!$emial) {
        throw new Exception('Invalid email');
    }
    
    $password = filter_input(INPUT_POST, 'password');
    if (!$password || mb_strlen($password) < 8) {
        throw new Exception('Password must contain 8+ characters');
    }
    
    $passwordHash = password_hash(
        $password,
        PASSWORD_DEFAULT,
        ['cost' => 12]
    );
    if ($passwordHash === false) {
        throw new Exception('Password hash failed');
    }
    
    $user = new User();
    $user->email = $email;
    $user->password_hash = $passwordHash;
    $user->save();
    
    header('HTTP/1.1 302 Redirect');
    header('Location: /login.php');
} catch (Exception $e) {
    header('HTTP/1.1 400 Bad request');
    echo $e->getMessage();
}
