<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for
 * this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in
 * getChat requests to check if the bot can use this method. Returns True on success
 *
 * Objects defined as-is october 2017
 *
 * @see https://core.telegram.org/bots/api#deletechatstickerset
 */
class DeleteChatStickerSet extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @channelusername)
     * @var string
     */
    public $chat_id = '';

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
