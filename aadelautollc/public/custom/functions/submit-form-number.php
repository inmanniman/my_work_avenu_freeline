<?php


$apiToken = "7005645265:AAFCzRJIyAOiA1JUXV7rZmsbIckYZCC1TUk";
$chatId = "1699758722";

$phoneNumber = $_POST['phone_number-form'];

// Формируем сообщение
$message = "Номер телефона: " . $phoneNumber;

// Формируем URL для запроса к API Telegram
$url = "https://api.telegram.org/bot{$apiToken}/sendMessage?chat_id={$chatId}&text=" . urlencode($message);

// Отправляем запрос
$response = file_get_contents($url);

// Проверяем ответ на ошибки
if ($response === false) {
    // Обработка ошибок при отправке запроса
    echo "Ошибка отправки сообщения.";
} else {
    // Обработка успешного ответа
    echo "Номер телефона успешно отправлен.";
}
