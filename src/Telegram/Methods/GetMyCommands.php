<?php

declare(strict_types=1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\BotCommandScope;
use lavolab\TelegramAPI\Telegram\Types\Custom\BotCommandArray;

/**
 * Use this method to get the current list of the bot's commands. Requires no parameters. Returns Array of BotCommand on
 * success.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#getmycommands
 */
class GetMyCommands extends TelegramMethods
{
    /**
     * A JSON-serialized object, describing scope of users. Defaults to BotCommandScopeDefault.
     * @var BotCommandScope
     */
    public $scope;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new BotCommandArray($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [];
    }

    public function performSpecialConditions(): TelegramMethods
    {
        if ($this->scope) {
            $this->scope = json_encode($this->scope);
        }
        return parent::performSpecialConditions();
    }
}
