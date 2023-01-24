<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\Exceptions\InvalidResultType;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use lavolab\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use lavolab\TelegramAPI\Telegram\Types\Message;

/**
 * Use this method to stop updating a live location message sent by the bot or via the bot (for inline bots) before
 * live_period expires. On success, if the message was sent by the bot, the sent Message is returned, otherwise True is
 * returned
 *
 * Objects defined as-is october 2017
 *
 * @see https://core.telegram.org/bots/api#stopmessagelivelocation
 */
class StopMessageLiveLocation extends TelegramMethods
{
    /**
     * Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target
     * channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Required if inline_message_id is not specified. Unique identifier of the sent message
     * @var int
     */
    public $message_id = 0;

    /**
     * Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string
     */
    public $inline_message_id = '';

    /**
     * Optional. A JSON-serialized object for an inline keyboard.
     * @var Markup
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        $returnValue = [];
        return $this->mandatoryUserOrInlineMessageId($returnValue);
    }

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        $typeOfResult = $data->getTypeOfResult();
        switch ($typeOfResult) {
            case 'array':
                return new Message($data->getResult(), $logger);
            case 'boolean':
                return new ResultBoolean($data->getResultBoolean(), $logger);
            default:
                throw new InvalidResultType('Result is of type: %s. Expecting one of array or boolean');
        }
    }
}
