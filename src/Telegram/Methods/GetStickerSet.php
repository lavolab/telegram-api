<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\StickerSet;

/**
 * Use this method to get a sticker set. On success, a StickerSet object is returned.
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#getstickerset
 */
class GetStickerSet extends TelegramMethods
{
    /**
     * Short name of the sticker set that is used in t.me/addstickers/ URLs (e.g., animals)
     * @var string
     */
    public $name = '';

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new StickerSet($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'name',
        ];
    }
}
