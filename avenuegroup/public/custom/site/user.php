<?php
session_start();



// Ваш текущий код user.php
// ...

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"/>

    <title>Главная</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link 
      rel="stylesheet"
      type="text/css" />
    <link rel="stylesheet" href="/assets/css/app.css" />
    <script defer src="/assets/js/app.js?v=27"></script>
  </head>

  <body>
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
    </div>
  </div>
</header>


<?php
require_once('blocks/footer.php');