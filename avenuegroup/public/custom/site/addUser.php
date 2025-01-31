<?php 
  session_start();
  
// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user']) || $_SESSION['user']['login'] !== 'admin') {
    header('Location: /');
    exit();
}
  require_once('../vendor/connect.php');
  require_once('blocks/head.php');
  require_once('blocks/header.php');

  $query = "SELECT users.telegram_id, users.fullname, users.departament, users.park FROM users";

  $result = mysqli_query($connect, $query);
?>

<section class="tables">
    <div class="filter-add container">
        <div class="filter-add__wrapper">
            <label class="filter-add__label" for="telegram-add">Телеграм ID:</label>
            <input class="filter-add__input" id="telegram-add" />
        </div>
        <div class="filter-add__wrapper">
            <label class="filter-add__label" for="name-add">ФИО:</label>
            <input class="filter-add__input" id="name-add" />
        </div>
        <div class="filter-add__wrapper">
            <label class="filter-add__label" for="departament-add">Подразделение:</label>
            <input class="filter-add__input" id="departament-add" />
        </div>
        <div class="filter-add__wrapper">
            <label class="filter-add__label" for="park-add">Парк:</label>
            <input class="filter-add__input" id="park-add" />
        </div>
        <div class="filter-add__wrapper-btn">
            <button class="filter-add__btn">Фильтр</button>
        </div>
    </div>

    <table class="tables container">
        <thead>
            <tr>
                <th><h1>Телеграмм ID</h1></th>
                <th><h1>ФИО</h1></th>
                <th><h1>Подразделение</h1></th>
                <th><h1>Парк</h1></th>
            </tr>
        </thead>
        <tbody>
            <span class="tables__error" id="no-results-message">Ничего не найдено</span>
            <?php 
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <tr>
                    <td>{$row['telegram_id']}</td>
                    <td>{$row['fullname']}</td>
                    <td>{$row['departament']}</td>
                    <td>{$row['park']}<button>X</button></td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</section>

<?php require_once('blocks/footer.php'); ?>
