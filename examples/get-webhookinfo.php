<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use lavolab\TelegramAPI\HttpClientRequestHandler;
use lavolab\TelegramAPI\Telegram\Methods\GetWebhookInfo;
use lavolab\TelegramAPI\Telegram\Types\WebhookInfo;
use lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$webHookInfo = new GetWebhookInfo();
$promise = $tgLog->performApiRequest($webHookInfo);

$promise->then(
    function (WebhookInfo $info) {
        echo '<pre>';
        var_dump($info);
        echo '</pre>';
    },
    function (\Exception $e) {
        var_dump($e);
    }
);
$loop->run();
