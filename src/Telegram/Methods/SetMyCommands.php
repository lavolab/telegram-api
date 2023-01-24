<?php

declare(strict_types=1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\BotCommand;
use lavolab\TelegramAPI\Telegram\Types\BotCommandScope;
use lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to change the list of the bot's commands. Returns True on success.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#setmycommands
 */
class SetMyCommands extends TelegramMethods
{
    /**
     * A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be
     * specified.
     *
     * @var BotCommand[]
     */
    public $commands;

    /**
     * A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to
     * BotCommandScopeDefault.
     *
     * @var BotCommandScope
     */
    public $scope;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'commands',
        ];
    }

    public function performSpecialConditions(): TelegramMethods
    {
        $this->commands = json_encode($this->commands);
        if ($this->scope) {
            $this->scope = json_encode($this->scope);
        }
        return parent::performSpecialConditions();
    }
}
