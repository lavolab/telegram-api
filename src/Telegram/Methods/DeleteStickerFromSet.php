<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to delete a sticker from a set created by the bot. Returns True on success
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#deletestickerfromset
 */
class DeleteStickerFromSet extends TelegramMethods
{
    /**
     * File identifier of the sticker
     * @var string
     */
    public $sticker = '';

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'sticker',
        ];
    }
}
