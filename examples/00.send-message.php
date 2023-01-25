<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use \React\EventLoop\Factory;
use \Lavolab\TelegramAPI\HttpClientRequestHandler;
use \Lavolab\TelegramAPI\TgLog;
use \Lavolab\TelegramAPI\Telegram\Methods\SendMessage;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world!';

$tgLog->performApiRequest($sendMessage);
$loop->run();
