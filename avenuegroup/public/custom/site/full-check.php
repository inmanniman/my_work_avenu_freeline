<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['login'] !== 'admin') {
    header('Location: /'); // Если не админ, перенаправляем на главную страницу
    exit();
}
// Функция для определения адреса по координатам с использованием Yandex Maps API
function getAddressByCoordinatesYandex($latitude, $longitude, $apiKey) {
    $url = "https://geocode-maps.yandex.ru/1.x/?apikey={$apiKey}&format=json&geocode={$longitude},{$latitude}";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['text'])) {
        return $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['text'];
    } else {
        return "Адрес не найден";
    }
}

// Функция для определения расстояния между двумя географическими точками
function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371000; // радиус Земли в метрах

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c;

    return $distance;
}

require_once('../vendor/connect.php');
session_start();

if (!$_SESSION['user']) {
    header('Location: /');
}

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
require_once('blocks/header.php');

// Запрос к базе данных
$query = "SELECT daily_location_data.telegram_id, users.fullname, users.departament, daily_location_data.latitude, daily_location_data.longitude, daily_location_data.datetime
          FROM daily_location_data
          JOIN users ON daily_location_data.telegram_id = users.telegram_id";
$result = mysqli_query($connect, $query);

// Центральные координаты Москвы
$centralLatitude = 55.58942601528739;
$centralLongitude = 37.63165574915834;

?>

    <div class="filter container">
        <div class="filter__wrapper-input">
            <div class="filter__search-name">
                <label for="name">ФИО:</label>
                <input type="text" id="name" placeholder="Введите имя" />
            </div>
            <div class="filter__search-departament">
                <label for="departament">Подразделение</label>
                <input type="text" id="departament" placeholder="Введите отдел" />
            </div>
            <div class="filter__search-data">
                <label for="datePeriod">Дата</label>
                <input type="text" id="datePeriod" name="datePeriod" />
            </div>
        </div>
        <div class="filter__wrapper-btn-radioinput">
            <div class="filter__wrapper-radioinput-ten">
                <div class="filter__wrapper-radioinput">
                    <input class="filter__rt" type="radio" id="in" name="zone">
                    <label class="filter__rt-label" for="in">В парке</label>

                    <input class="filter__rr" type="radio" id="outside" name="zone">
                    <label class="filter__rr-label" for="outside">Вне парка</label>
                </div>
                <div class="filter__wrapper-ten">
                    <input class="filter__ten" type="checkbox" id="ten" name="ten" />
                    <label class="filter__ten-label" for="ten">Опаздавшие</label>
                </div>
            </div>
            <div class="filter__wrapper-reset-btn">
                <div class="filter__wrapper-download-btn">
                    <button class="filter__download-btn">Скачать</button>
                </div>
                <div class="filter__wrapper-reset">
                    <button class="filter__btn-reset">Сбросить</button>
                </div>
                <div class="filter__wrapper-btn">
                    <button class="filter__btn">Фильтр</button>
                </div>
            </div>
        </div>
    </div>

    <table class="tables container" id="tables">
        <thead>
            <tr>
                <th><h1>ФИО</h1></th>
                <th><h1>Подразделение</h1></th>
                <th><h1>Дата и время</h1></th>
                <th><h1>Адрес</h1></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Вывод данных из базы в таблицу
            while ($row = mysqli_fetch_assoc($result)) {
                $address = getAddressByCoordinatesYandex($row['latitude'], $row['longitude'], '8af9d2f7-264e-411a-948e-2bd257d3a37a');
                $distance = calculateDistance($centralLatitude, $centralLongitude, $row['latitude'], $row['longitude']);
                
                echo "
                <tr data-distance='{$distance}'>
                    <td>{$row['fullname']}</td>
                    <td>{$row['departament']}</td>
                    <td>{$row['datetime']}</td>";

                if ($distance > 60) {
                    echo "<td style='color:red;'>{$address}!!!!!</td>";
                } else {
                    echo "<td>{$address}</td>";
                }

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

<?php
require_once('blocks/footer.php');
?>