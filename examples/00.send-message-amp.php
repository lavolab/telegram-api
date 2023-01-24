<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use \lavolab\TelegramAPI\TgLog;
use \lavolab\TelegramAPI\Telegram\Methods\SendMessage;

\Amp\Loop::run(function () {
    $logger = (new \Monolog\Logger("log"))->pushHandler(new StreamHandler(STDOUT, Logger::ERROR));
    $tgLog = new TgLog(BOT_TOKEN, new \lavolab\TelegramAPI\HttpClientRequestHandlerAmp(), $logger);

    $sendMessage = new SendMessage();
    $sendMessage->chat_id = A_USER_CHAT_ID;
    $sendMessage->text = 'Hello world!';

    $result = yield $tgLog->performApiRequest($sendMessage);

    var_dump($result);
});