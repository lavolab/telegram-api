<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\HttpClientRequestHandler;
use lavolab\TelegramAPI\Telegram\Methods\SetWebhook;
use lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$webhook = new SetWebhook();
$webhook->url = 'https://example.com/';
$webhook->max_connections = 3;
$webhook->allowed_updates = ['message'];
$webhook->drop_pending_updates = true;
$webhook->secret_token = 'some-very-secret-string';

$promise = $tgLog->performApiRequest($webhook);
$promise->then(
    function (TelegramTypes $response) {
        echo 'Webhook was successfully set. Run get-webhookinfo.php to get detailed information about webhook from server.';
    },
    function (\Exception $exception) {
        var_dump($exception->getMessage());
    }
);

$loop->run();
