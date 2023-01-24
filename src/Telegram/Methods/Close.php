<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to close the bot instance before moving it from one local server to another. You need to delete the
 * webhook before calling this method to ensure that the bot isn't launched again after server restart. The method will
 * return error 429 in the first 10 minutes after the bot is launched. Returns True on success. Requires no parameters.
 *
 * Objects defined as-is november 2020
 *
 * @see https://core.telegram.org/bots/api#logout
 */
class Close extends TelegramMethods
{
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [];
    }
}
