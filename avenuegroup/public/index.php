<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Проверяем, авторизован ли пользователь
if (isset($_SESSION['user'])) {
    // Проверяем логин пользователя и перенаправляем соответственно
    if ($_SESSION['user']['login'] === 'admin') {
        header('Location: /custom/site/full-check.php');
    } else {
        header('Location: /custom/site/user.php');
    }
    exit();
}

// title
echo "<script>document.title = 'Авторизация';</script>";

require_once('custom/site/blocks/head.php');
?>
<div class="authorization">
    <svg class="authorization__logo" width="40" height="40">
        <use href="/assets/sprite.svg#logo"></use>
    </svg>
    <div class="authorization__wrapper container">
        <h1 class="authorization__title">Вход</h1>

        <form class="authorization__form container" action="/custom/vendor/signup.php" method="post">
            <label for="login" class="authorization__txt">Логин:</label>
            <input class="authorization__input" type="text" id="login" name="login" placeholder="Введите логин" required="required" />
            <label for="password" class="authorization__txt">Пароль:</label>
            <input class="authorization__input" type="password" id="password" name="password" placeholder="Введите пароль" required="required" />
            <?php
            if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
                unset($_SESSION['message']);
            }
            ?>
            <div class="authorization__wrapper-btn">
                <button type="submit" class="authorization__btn btn-primary btn-block btn-large">Войти</button>
            </div>
        </form>

    </div>
</div>

<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>
<?php
require_once('custom/site/blocks/footer.php');
?>