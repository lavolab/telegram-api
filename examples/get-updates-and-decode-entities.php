<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use \Lavolab\TelegramAPI\HttpClientRequestHandler;
use Lavolab\TelegramAPI\Telegram\Methods\GetUpdates;
use \Lavolab\TelegramAPI\Abstracts\TraversableCustomType;
use Lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$getUpdates = new GetUpdates();

// If using this method, send an offset (AKA last known update_id) to avoid getting duplicate update notifications.
#$getUpdates->offset = 328221148;
$updatePromise = $tgLog->performApiRequest($getUpdates);
$updatePromise->then(
    function (TraversableCustomType $updatesArray) {
        foreach ($updatesArray as $update) {
            $decodedText = $update->message->decodeEntities('HTML'); //or MarkdownV2 or Markdown (abandoned, only for backward compatibility)
            echo $decodedText;
        }
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
    }
);

$loop->run();
