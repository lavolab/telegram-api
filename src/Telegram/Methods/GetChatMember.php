<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Use this method to get information about a member of a chat. Returns a ChatMember object on success
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#getchatmember
 */
class GetChatMember extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Unique identifier of the target user
     * @var int
     */
    public $user_id = 0;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ChatMember($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'user_id',
        ];
    }
}
