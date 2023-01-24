<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\WebhookInfo;

/**
 * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If
 * the bot is using getUpdates, will return an object with the url field empty.
 *
 * Objects defined as-is october 2016
 *
 * @see https://core.telegram.org/bots/api/#getwebhookinfo
 */
class GetWebhookInfo extends TelegramMethods
{
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new WebhookInfo($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [];
    }
}
