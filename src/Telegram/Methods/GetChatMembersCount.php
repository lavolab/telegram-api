<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\Custom\ResultInt;

/**
 * Use this method to get the number of members in a chat. Returns Int on success
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#getchat
 */
class GetChatMembersCount extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @channelusername)
     * @var string
     */
    public $chat_id = '';

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultInt($data->getResultInt(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
        ];
    }
}
