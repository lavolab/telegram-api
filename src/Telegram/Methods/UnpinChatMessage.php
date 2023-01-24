<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to remove a message from the list of pinned messages in a chat. If the chat is not a private chat,
 * the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in a
 * supergroup or 'can_edit_messages' admin right in a channel. Returns True on success
 *
 * Objects defined as-is november 2020, Bot API v5.0
 *
 * @see https://core.telegram.org/bots/api#unpinchatmessage
 */
class UnpinChatMessage extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @var string
     */
    public $chat_id = '';

    /**
     * Optional. Identifier of a message to unpin. If not specified, the most recent pinned message (by sending date)
     * will be unpinned
     * @var int
     */
    public $message_id;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
        ];
    }
}
