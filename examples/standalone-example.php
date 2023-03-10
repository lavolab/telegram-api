<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use Lavolab\TelegramAPI\HttpClientRequestHandler;
use Lavolab\TelegramAPI\Telegram\Methods\GetMe;
use Lavolab\TelegramAPI\Telegram\Methods\SendMessage;
use Lavolab\TelegramAPI\Telegram\Types\User;
use Lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$getMe = new GetMe();
$promise = $tgLog->performApiRequest($getMe);

$promise->then(function (User $userInformation) {
    printf(
        'This bot is called <strong>%s</strong> (username %s) and has id <strong>%d</strong>%s',
        $userInformation->first_name,
        $userInformation->username,
        $userInformation->id,
        PHP_EOL
    );
});

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world to the user... now revamped!';
$tgLog->performApiRequest($sendMessage);

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_GROUP_CHAT_ID;
$sendMessage->text = 'And this is an hello the the group... from scratch :D';
$tgLog->performApiRequest($sendMessage);

$loop->run();
