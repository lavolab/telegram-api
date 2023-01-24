<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Types\Custom;

use lavolab\TelegramAPI\Abstracts\TraversableCustomType;
use lavolab\TelegramAPI\Telegram\Types\Passport\PassportFile;
use lavolab\TelegramAPI\Telegram\Types\PhotoSize;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class PassportFileArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $id => $passportFile) {
                $this->data[$id] = new PassportFile($passportFile, $logger);
            }
        }
    }
}
