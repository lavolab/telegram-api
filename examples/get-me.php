<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use Lavolab\TelegramAPI\HttpClientRequestHandler;
use Lavolab\TelegramAPI\Telegram\Methods\GetMe;
use Lavolab\TelegramAPI\TgLog;
use \Lavolab\TelegramAPI\Abstracts\TelegramTypes;

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
