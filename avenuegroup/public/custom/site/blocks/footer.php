<?php 
// Проверяем, что пользователь не авторизован и не находится на странице входа
if (empty($_SESSION['user']) && basename($_SERVER['PHP_SELF']) !== 'index.php') {
    header('Location: /index.php');
    exit();
}
?>

<footer></footer>