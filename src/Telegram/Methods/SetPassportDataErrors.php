<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use Lavolab\TelegramAPI\Telegram\Types\Passport\PassportElementError;

/**
 * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an
 * administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success
 *
 * Note: In regular groups (non-supergroups), this method will only work if the ‘All Members Are Admins’ setting is
 * off in the target group
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#setchattitle
 */
class SetPassportDataErrors extends TelegramMethods
{
    /**
     * User identifier
     * @var string
     */
    public $user_id = 0;

    /**
     * A JSON-serialized array describing the errors
     * @var PassportElementError[]
     */
    public $errors = [];

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'user_id',
            'errors',
        ];
    }
}
