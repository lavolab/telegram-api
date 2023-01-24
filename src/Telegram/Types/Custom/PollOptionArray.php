<?php
declare(strict_types=1);

namespace lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TraversableCustomType;
use lavolab\TelegramAPI\Telegram\Types\PollOption;
use function count;

/**
 * Used for methods that will return an array of messages
 */
class PollOptionArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $telegramResponse) {
                // Create an actual Update object and fill the array
                $this->data[] = new PollOption($telegramResponse, $logger);
            }
        }
    }
}
