<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TraversableCustomType;
use Lavolab\TelegramAPI\Telegram\Types\Update;

/**
 * Mockup class to generate a real telegram update representation
 */
class UpdatesArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $telegramResponse) {
                // Create an actual Update object and fill the array
                $this->data[] = new Update($telegramResponse, $logger);
            }
        }
    }
}
