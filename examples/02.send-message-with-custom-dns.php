<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use \React\EventLoop\Factory;
use \lavolab\TelegramAPI\HttpClientRequestHandler;
use \lavolab\TelegramAPI\TgLog;
use \lavolab\TelegramAPI\Telegram\Methods\SendMessage;

$loop = Factory::create();
// Passing along an array with options will allow you to choose a custom DNS that isn't 8.8.8.8
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop, ['dns' => '8.8.4.4']));

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world!';

$tgLog->performApiRequest($sendMessage);
$loop->run();
