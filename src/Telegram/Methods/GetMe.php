<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\User;

/**
 * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in
 * form of a User object.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#getme
 */
class GetMe extends TelegramMethods
{
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new User($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [];
    }
}
