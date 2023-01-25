<?php

declare(strict_types=1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\BotCommandScope;
use Lavolab\TelegramAPI\Telegram\Types\Custom\BotCommandArray;

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
