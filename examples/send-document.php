<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use Lavolab\TelegramAPI\HttpClientRequestHandler;
use Lavolab\TelegramAPI\Telegram\Methods\GetFile;
use Lavolab\TelegramAPI\Telegram\Methods\SendDocument;
use Lavolab\TelegramAPI\Telegram\Types\Custom\InputFile;
use Lavolab\TelegramAPI\TgLog;
use function Clue\React\Block\await;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$sendDocument = new SendDocument();
$sendDocument->chat_id = A_USER_CHAT_ID;
$sendDocument->document = new InputFile(__FILE__);
$sendDocument->thumb = new InputFile(__DIR__ . '/binary-test-data/logo-php7-telegram-bot-api-thumbnail.jpg');

$promise = $tgLog->performApiRequest($sendDocument);

$promise->then(
    function ($response) use ($tgLog, $loop) {
        echo '<pre>';
        var_dump($response);
        echo '</pre>';
        /** @var $response \Lavolab\TelegramAPI\Telegram\Types\Message */

        // Load uploaded video and generate URL to download using bot token
        $getFileVideo = new GetFile();
        $getFileVideo->file_id = $response->document->file_id;
        $fileVideo = await($tgLog->performApiRequest($getFileVideo), $loop);
        var_dump('Document url: ' . $tgLog->fileUrl($fileVideo));

        // Load uploaded thumbnail and generate URL to download using bot token
        $getFileThumb = new GetFile();
        $getFileThumb->file_id = $response->document->thumb->file_id;
        $fileThumb = await($tgLog->performApiRequest($getFileThumb), $loop);
        var_dump('Thumbnail url: ' . $tgLog->fileUrl($fileThumb));
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
    }
);

$loop->run();
