<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\Exceptions\InvalidResultType;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use Lavolab\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use Lavolab\TelegramAPI\Telegram\Types\Message;

/**
 * Use this method to edit live location messages sent by the bot or via the bot (for inline bots). A location can be
 * edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On
 * success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned
 *
 * Objects defined as-is october 2017
 *
 * @see https://core.telegram.org/bots/api#editmessagelivelocation
 */
class EditMessageLiveLocation extends TelegramMethods
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
     * Latitude of new location
     * @var float
     */
    public $latitude = 0.0;

    /**
     * Longitude of new location
     * @var float
     */
    public $longitude = 0.0;

    /**
     * Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @var float
     */
    public $horizontal_accuracy = 0.0;

    /**
     * Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if
     * specified
     * @var int
     */
    public $heading;

    /**
     * Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in
     * meters. Must be between 1 and 100000 if specified.
     * @var int
     */
    public $proximity_alert_radius;

    /**
     * Optional. A JSON-serialized object for an inline keyboard.
     * @var Markup
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        $returnValue = [
            'longitude',
            'latitude',
        ];
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
