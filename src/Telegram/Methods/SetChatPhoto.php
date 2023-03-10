<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Generator;
use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\Custom\InputFile;
use Lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be
 * an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success
 *
 * Note: In regular groups (non-supergroups), this method will only work if the ‘All Members Are Admins’ setting is
 * off in the target group
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#setchatphoto
 */
class SetChatPhoto extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * New chat photo, uploaded using multipart/form-data
     * @var InputFile
     */
    public $photo;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'photo',
        ];
    }

    public function hasLocalFiles(): bool
    {
        return $this->photo instanceof InputFile;
    }

    public function getLocalFiles(): Generator
    {
        yield 'photo' => $this->photo;
    }
}
