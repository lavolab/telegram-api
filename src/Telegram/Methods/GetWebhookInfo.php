<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\WebhookInfo;

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
