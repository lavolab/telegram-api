<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\HttpClientRequestHandler;
use lavolab\TelegramAPI\Telegram\Types\BotCommand;
use lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$promise = $tgLog->performApiRequest(new \lavolab\TelegramAPI\Telegram\Methods\GetMyCommands());
$promise->then(
    function (TelegramTypes $response) {
        var_dump(sprintf('There are %d command(s) for default scope.', count($response->data)));
        foreach($response->data as $command) {
            /** @var $command BotCommand */
            printf('/%s - %s' . PHP_EOL, $command->command, $command->description);
        }
    },
    function (\Exception $e) {
        var_dump($e->getTraceAsString());
    }
);

$loop->run();
