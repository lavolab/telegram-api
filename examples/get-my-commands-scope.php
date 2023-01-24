<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\HttpClientRequestHandler;
use lavolab\TelegramAPI\Telegram\Methods\GetMyCommands;
use lavolab\TelegramAPI\Telegram\Types\BotCommand;
use lavolab\TelegramAPI\Telegram\Types\BotCommandScope;
use lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$scopeType = 'all_private_chats';

$method = new GetMyCommands();
$method->scope = new BotCommandScope();
$method->scope->type = $scopeType;

$promise = $tgLog->performApiRequest($method);
$promise->then(
    function (TelegramTypes $response) use ($scopeType) {
        var_dump(sprintf('There are %d command(s) for scope "%s"', count($response->data), $scopeType));
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
