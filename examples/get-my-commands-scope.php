<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\HttpClientRequestHandler;
use Lavolab\TelegramAPI\Telegram\Methods\GetMyCommands;
use Lavolab\TelegramAPI\Telegram\Types\BotCommand;
use Lavolab\TelegramAPI\Telegram\Types\BotCommandScope;
use Lavolab\TelegramAPI\TgLog;

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
