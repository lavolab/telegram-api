<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\ChatPermissions;
use lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a
 * supergroup for this to work and must have the can_restrict_members admin rights. Returns True on success
 *
 * Objects defined as-is may 2020
 *
 * @see https://core.telegram.org/bots/api#setchatpermissions
 */
class SetChatPermissions extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @var string
     */
    public $chat_id = '';

    /**
     * New default chat permissions
     * @var ChatPermissions
     */
    public $permissions;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'permissions',
        ];
    }
}
