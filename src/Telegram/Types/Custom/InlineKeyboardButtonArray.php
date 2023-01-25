<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TraversableCustomType;
use Lavolab\TelegramAPI\Telegram\Types\Inline\Keyboard\Button;

/**
 * Mockup class to generate a real telegram update representation
 */
class InlineKeyboardButtonArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $rowId => $buttons) {
                $rowButtons = [];
                foreach ($buttons as $button) {
                    $rowButtons[] = new Button($button, $logger);
                }
                $this->data[$rowId] = $rowButtons;
            }
        }
    }
}
