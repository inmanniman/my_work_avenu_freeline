<?php 
  session_start();
  
  if (!$_SESSION['user']) {
    header('Location: /');
  }
?>


<header class="header">
  <div class="header__content container">
    <div class="header__wrapper-icon">
      <svg class="header__icon" width="60" height="60">
        <use href="/assets/sprite.svg#logo"></use>
      </svg>
      <span>Admin</span>
      <a href="/custom/site/addUser.php">Добавить пользователя</a>
    </div>
    <a href="../vendor/logout.php" class="header__logout">Выход</a>
  </div>
</header>

