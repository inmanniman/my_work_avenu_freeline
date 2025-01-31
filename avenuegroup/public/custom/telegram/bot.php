<?php
$token = '6501542832:AAGd1cNhgZyK6pstwyeC942jg_hirGJpwRk';
$secretKey = 'AAGd1cNhgZyK6pstwyeC942jg_hirGJpwRk'; // Замените на свой секретный ключ

$update = json_decode(file_get_contents('php://input'), true);

$chatId = isset($update['message']['chat']['id']) ? $update['message']['chat']['id'] : '';

if ($update && isset($update['message']['text']) && $update['message']['text'] == '/start') {
    $urlWithKey = 'https://avenugroup.ru/custom/telegram/send-location.php?user_id=' . $chatId . '&key=' . $secretKey;

    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => 'Отправить ID', 'callback_data' => 'send_id'],
                ['text' => 'Перейти по ссылке', 'url' => $urlWithKey],
                
            ],
        ],
    ];

    $replyMarkup = json_encode($keyboard);
    $parameters = [
        'chat_id' => $chatId,
        'text' => 'Выберите действие:',
        'reply_markup' => $replyMarkup,
    ];

    file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($parameters));
}

if ($update && isset($update['callback_query'])) {
    $callbackQuery = $update['callback_query'];
    $callbackData = $callbackQuery['data'];

    switch ($callbackData) {
        case 'send_id':
            file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id={$callbackQuery['message']['chat']['id']}&text={$callbackQuery['message']['chat']['id']}");
            break;
    }
}
?>