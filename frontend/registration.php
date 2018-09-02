<?php
/**
 * Created by PhpStorm.
 * User: bashska
 * Date: 31.08.18
 * Time: 11:47
 */

include '/var/www/bash.inc/engine/engine.php';

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST['password2'])) {
    $errors = [];
    // Формируем массив для JSON ответа
    $result = [
        'name' => $_POST["name"],
        'email' => $_POST["email"],
        'password' => $_POST["password"],
        'password2' => $_POST["password2"]
    ];

    if (strlen($result['name']) < 4 || strlen($result['name']) > 20) {
        $errors['user'] = 'bad';
        $result = 'Имя должно быть от 4 до 20 символов';
    } elseif ($result['password'] != $result['password2']) {
        $errors['user'] = 'bad';
        $result = 'Повторный пароль введен неверно';
    }   elseif (empty($errors)) {
        $result['password'] = password_hash($result['password'], PASSWORD_DEFAULT);
        $result = signUp($result['name'], $result['email'], $result['password']);
    }


    // Отправляет AJAX обратно, не удалять!
    echo json_encode($result);
}

?>



