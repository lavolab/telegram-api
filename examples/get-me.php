<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use lavolab\TelegramAPI\HttpClientRequestHandler;
use lavolab\TelegramAPI\Telegram\Methods\GetMe;
use lavolab\TelegramAPI\TgLog;
use \lavolab\TelegramAPI\Abstracts\TelegramTypes;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$getMePromise = $tgLog->performApiRequest(new GetMe());
$getMePromise->then(
    function (TelegramTypes $getMeResponse) {
        var_dump($getMeResponse);
    },
    function (\Exception $e) {
        var_dump($e);
    }
);

$loop->run();
