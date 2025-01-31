<?php

// Функция для удаления прошлых дат из файла JSON
function removePastDates($filePath)
{
    // Получаем текущую дату в формате "m/d/Y"
    $currentDate = date("m/d/Y");

    // Получаем текущие данные из файла JSON
    $currentData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : array();

    // Проверяем каждую запись на предмет прошедших дат и удаляем их
    foreach ($currentData as $date => $data) {
        // Если дата меньше текущей даты, удаляем запись
        if (strtotime($date) < strtotime($currentDate)) {
            unset($currentData[$date]);
        }
    }

    // Конвертируем массив в JSON с отступами для читаемости
    $jsonData = json_encode($currentData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    // Пытаемся записать обновленные данные в файл
    file_put_contents($filePath, $jsonData);
}

// Задаем переменные для API токена и ID чата
$apiToken = "7005645265:AAFCzRJIyAOiA1JUXV7rZmsbIckYZCC1TUk";
$chatIds = array("1699758722", "729933673"); // Добавлены дополнительные chatId

// Получаем данные из POST-запроса
$fullName = $_POST['full_name'];
$carBrand = $_POST['car_brand'];
$typeCar = $_POST['type_car'];
$VIN = $_POST['VIN'];
$cityStreet = $_POST['city_street'];
$datePeriod = $_POST['period'];
$phoneNumber = $_POST['phone_number'];
$comment = $_POST['comment'];

// Форматируем дату и время в требуемый вид
$formattedDate = date("m/d/Y", strtotime($datePeriod));
$formattedTime = date("h:ia", strtotime($datePeriod));

// Путь к файлу JSON
$filePath = "date.json";

// Удаляем прошлые даты из файла JSON
removePastDates($filePath);

// Получаем текущие данные из файла JSON, если он существует
$currentData = json_decode(file_get_contents($filePath), true);

// Проверяем, существует ли уже запись для данной даты
if (isset($currentData[$formattedDate])) {
    // Если запись существует, проверяем, есть ли уже такое время в массиве
    if (!in_array($formattedTime, $currentData[$formattedDate]["times"])) {
        // Если времени еще нет, добавляем его в массив
        $currentData[$formattedDate]["times"][] = $formattedTime;
    }
} else {
    // Если запись отсутствует, создаем новую запись с временем для данной даты
    $currentData[$formattedDate] = array(
        "times" => array($formattedTime)
    );
}

// Конвертируем массив в JSON с отступами для читаемости
$jsonData = json_encode($currentData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// Пытаемся записать обновленные данные в файл
if (file_put_contents($filePath, $jsonData) !== false) {
    echo "Файл успешно обновлен";
} else {
    echo "Произошла ошибка при обновлении файла";
}

// Формируем сообщение
$message = "Форма заявления\n\n" .
    "Имя: " . $fullName . "\n" .
    "Марка автомобиля: " . $carBrand . "\n" .
    "Тип двигателя: " . $typeCar . "\n" .
    "VIN номер: " . $VIN . "\n" .
    "Адрес: " . $cityStreet . "\n" .
    "Дата: " . $datePeriod . "\n" .
    "Телефон: " . $phoneNumber . "\n" .
    "Комментарий: " . $comment . "\n";

    
// Отправляем сообщение для каждого chatId
foreach ($chatIds as $chatId) {
    // Формируем URL для запроса к API Telegram
    $url = "https://api.telegram.org/bot{$apiToken}/sendMessage?chat_id={$chatId}&text=" . urlencode($message);

    // Отправляем запрос
    $response = file_get_contents($url);

    // Проверяем ответ на ошибки
    if ($response === false) {
        // Обработка ошибок при отправке запроса
        echo "Ошибка отправки сообщения для chatId: {$chatId}.";
    } else {
        // Обработка успешного ответа
        echo "Сообщение успешно отправлено для chatId: {$chatId}.";
    }
}
