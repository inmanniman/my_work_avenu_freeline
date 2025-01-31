<?php
// Подключение к базе данных
require_once('../vendor/connect.php');

// Запуск сессии
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
  }
// Проверка наличия и правильности ключа
$expectedKey = 'AAGd1cNhgZyK6pstwyeC942jg_hirGJpwRk'; // Замените на свой секретный ключ
$receivedKey = isset($_GET['key']) ? $_GET['key'] : null;

if ($receivedKey !== $expectedKey) {
    // Пользователь не авторизован, можете отправить сообщение об ошибке или выполнить другие действия
    echo "Если выходит ошибка, то обратиться к администратору";
    exit;
}

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_GET['user_id'];
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;

    // Проверяем, отправлял ли пользователь сегодня уже данные
    $today = date('Y-m-d');
    $queryCheckToday = "SELECT * FROM daily_location_data WHERE telegram_id = '$userId' AND DATE(datetime) = '$today'";
    $resultCheckToday = mysqli_query($connect, $queryCheckToday);

    if ($resultCheckToday && mysqli_num_rows($resultCheckToday) > 0) {
        $_SESSION['message'] = "Вы уже отправляли местоположение за сегодня";
    } else {
        // Проверяем существование пользователя в базе данных
        $queryCheckUser = "SELECT * FROM users WHERE telegram_id = '$userId'";
        $resultCheckUser = mysqli_query($connect, $queryCheckUser);

        if ($resultCheckUser && mysqli_num_rows($resultCheckUser) > 0) {
            // Пользователь существует, обновляем данные
            $queryUpdate = "INSERT INTO daily_location_data (telegram_id, latitude, longitude, datetime) VALUES ('$userId', '$latitude', '$longitude', NOW())";
            $resultUpdate = mysqli_query($connect, $queryUpdate);

            if ($resultUpdate) {
                $_SESSION['message'] = "Данные успешно обновлены";
            } else {
                $_SESSION['message'] = "Ошибка при обновлении данных";
            }
        } else {
            $_SESSION['message'] = "Пользователь не найден";
        }
    }

    // Возвращаем результат запроса (может потребоваться обработка на стороне клиента)
    echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
    exit;
}

// Проверка наличия сообщения в сессии
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;

// Удаление сообщения из сессии
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"/>
    <title>Начало рабочего времени</title>
    <link rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/app.css"/>
    <script defer src="/assets/js/app.js"></script>
</head>

<body>
    <div class="geo-tg">
        <form id="locationForm">
            <div class="geo-tg__txt">Подтвердите отправку</div>
            <div class="geo-tg__btn-wrapper">
                <button type="button" class="geo-tg__btn" onclick="sendLocation()">Начало рабочего времени</button>
            </div>
            <span class="geo-tg__error-done">
                <?php echo isset($message) ? $message : ''; ?>
            </span>
        </form>
    </div>
</body>
</html>