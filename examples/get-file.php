<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use Lavolab\TelegramAPI\HttpClientRequestHandler;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramDocument;
use Lavolab\TelegramAPI\Telegram\Methods\GetFile;
use Lavolab\TelegramAPI\Telegram\Types\File;
use Lavolab\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$getFile = new GetFile();
// You can get a file id from an update, webhook or any other message object
$getFile->file_id = A_FILE_ID;

$filePromise = $tgLog->performApiRequest($getFile);
$filePromise->then(
    function (File $file) use ($tgLog) {
        $documentPromise = $tgLog->downloadFile($file);
        $documentPromise->then(function (TelegramDocument $tgDocument) use ($file) {
            // Offer to download the file immediately
            header(sprintf('Content-Type: %s', $tgDocument->mime_type));
            header(sprintf('Content-Length: %d', $tgDocument->file_size));
            header(sprintf('Content-Disposition: inline; filename="%s"', basename($file->file_path)));
            print $tgDocument;
        });
    }
);

$loop->run();
