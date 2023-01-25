<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\HttpClientRequestHandler;
use Lavolab\TelegramAPI\Telegram\Types\BotCommand;
use Lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$promise = $tgLog->performApiRequest(new \Lavolab\TelegramAPI\Telegram\Methods\GetMyCommands());
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
