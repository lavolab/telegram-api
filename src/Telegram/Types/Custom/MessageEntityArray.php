<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TraversableCustomType;
use lavolab\TelegramAPI\Telegram\Types\MessageEntity;

/**
 * Mockup class to generate a real telegram update representation
 */
class MessageEntityArray extends TraversableCustomType
{
    /**
     * @param array|null $data
     * @param LoggerInterface|null $logger

     * @noinspection MagicMethodsValidityInspection
     * @noinspection PhpMissingParentConstructorInspection
     */
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $id => $messageEntity) {
                $this->data[$id] = new MessageEntity($messageEntity, $logger);
            }
        }
    }
}
