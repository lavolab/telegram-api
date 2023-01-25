<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TraversableCustomType;
use Lavolab\TelegramAPI\Telegram\Types\Sticker;

/**
 * Mockup class to generate a real telegram update representation
 */
class StickerSetArray extends TraversableCustomType
{
    public function __construct(array $result = null, LoggerInterface $logger = null)
    {
        if (count($result) !== 0) {
            foreach ($result as $id => $sticker) {
                $this->data[$id] = new Sticker($sticker, $logger);
            }
        }

        parent::__construct(null, $logger);
    }
}
