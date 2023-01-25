<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use Lavolab\TelegramAPI\Exceptions\ClientException;
use Lavolab\TelegramAPI\HttpClientRequestHandler;
use Lavolab\TelegramAPI\Telegram\Methods\GetChatMembersCount;
use Lavolab\TelegramAPI\TgLog;
use Lavolab\TelegramAPI\Telegram\Types\Custom\ResultInt;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$getCMC = new GetChatMembersCount();
$getCMC->chat_id = A_GROUP_CHAT_ID;

$getChatMembersCountPromise = $tgLog->performApiRequest($getCMC);
$getChatMembersCountPromise->then(
    function (ResultInt $getChatMembersCountResponse) {
        echo 'The number of participants in this chat are '.$getChatMembersCountResponse. ' members'.PHP_EOL;
        echo '<pre>';
        var_dump($getChatMembersCountResponse);
        echo '</pre>';
    },
    function (ClientException $e) {
        var_dump('Captured ClientException', $e->getError());
    }
);

$loop->run();
