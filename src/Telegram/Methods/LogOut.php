<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot
 * before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful
 * call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server
 * for 10 minutes. Returns True on success. Requires no parameters.
 *
 * Objects defined as-is november 2020
 *
 * @see https://core.telegram.org/bots/api#logout
 */
class LogOut extends TelegramMethods
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
