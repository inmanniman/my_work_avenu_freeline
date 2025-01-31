<?php
require_once('custom/blocks/head.php');
?>

<body>
    <?php
    // шапка и первый блок
    require_once('custom/blocks/header.php');

    // сервис помощи
    require_once('custom/blocks/services-help.php');

    // преимущества
    require_once('custom/blocks/advantages.php');

    // о компании
    require_once('custom/blocks/about.php');

    // Свайпер техподдержка
    require_once('custom/blocks/swiper-support.php');

    // свайпер отзывы
    require_once('custom/blocks/swiper-reviews.php');

    // автопомощь на дороге
    require_once('custom/blocks/autosupport-road.php');

    // контактная ифнормация
    require_once('custom/blocks/contact.php');

    // модальное окно
    require_once('custom/blocks/modal-window.php');
    require_once('custom/auto-help/disabling-car.php');
    require_once('custom/auto-help/opening-doors.php');
    require_once('custom/auto-help/starting-engine.php');
    require_once('custom/auto-help/wheel-replacement.php');

    // подвал
    require_once('custom/blocks/footer.php');
    ?>

</body>