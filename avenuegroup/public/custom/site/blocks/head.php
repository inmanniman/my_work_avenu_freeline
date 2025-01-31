<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Проверяем, что пользователь не авторизован и не находится на странице входа
if (empty($_SESSION['user']) && basename($_SERVER['PHP_SELF']) !== 'index.php') {
  header('Location: /index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"/>

    <title>Заголовок моей страницы</title>
    <link 

      rel="stylesheet"
      type="text/css" />
    <link rel="stylesheet" href="/assets/css/app.css" />
    <script defer src="/assets/js/app.js?v=27"></script>
  </head>

  <body>
