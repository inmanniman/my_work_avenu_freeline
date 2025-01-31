<?php
require_once('connect.php');
session_start();

// Получаем значения из POST-запроса
$login = $_POST['login'];
$password = $_POST['password'];

// Используем подготовленное выражение для безопасности от SQL-инъекций
$check_user = mysqli_prepare($connect, "SELECT * FROM `admin` WHERE `login` = ? AND `psw` = ?");
mysqli_stmt_bind_param($check_user, 'ss', $login, $password);
mysqli_stmt_execute($check_user);

// Получаем результат выполнения запроса
$result = mysqli_stmt_get_result($check_user);

// Проверяем, есть ли пользователь с введенным логином и паролем
if (mysqli_num_rows($result) > 0) {
    // Если пользователь найден, можно получить его данные
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user'] = [
        "login" => $user['login'],
        "password" => $user['password']
    ];

    // Проверяем логин пользователя и перенаправляем соответственно
    if ($user['login'] === 'admin') {
        header('Location: /custom/site/full-check.php');
    } else {
        header('Location: /custom/site/user.php');
    }
    exit();
} else {
    // Если пользователь не найден, устанавливаем сообщение в сессию и перенаправляем на другую страницу
    $_SESSION['message'] = 'Неверный логин и пароль';
    header('Location: /index.php');
}

?>