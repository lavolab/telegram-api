<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use lavolab\TelegramAPI\HttpClientRequestHandler;
use lavolab\TelegramAPI\Telegram\Methods\SendChatAction;
use lavolab\TelegramAPI\Telegram\Methods\SendVideo;
use lavolab\TelegramAPI\Telegram\Types\Custom\InputFile;
use lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

// Let the user know we are doing some intensive stuff
$sendChatAction = new SendChatAction();
$sendChatAction->chat_id = A_USER_CHAT_ID;
$sendChatAction->action = 'upload_video';
$tgLog->performApiRequest($sendChatAction);
$loop->run();

$sendVideo = new SendVideo();
$sendVideo->chat_id = A_USER_CHAT_ID;
$sendVideo->video = new InputFile('binary-test-data/demo-video.mp4');
$sendVideo->caption = 'Example of a video file sent with Telegram';

$promise = $tgLog->performApiRequest($sendVideo);

$promise->then(
    function ($response) {
        echo '<pre>';
        var_dump($response);
        echo '</pre>';
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
    }
);

$loop->run();
